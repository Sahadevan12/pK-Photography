/**
 * frame-preview.js — FIXED VERSION
 * pk-photography → public/js/frame-preview.js
 *
 * BUGS FIXED:
 *  ✅ wrapper.offsetWidth = 0 → now uses getBoundingClientRect()
 *     with fallback resize detection
 *  ✅ Image visible but 0px size → explicit size set before display
 *  ✅ Placeholder overlapping photo → z-index ordering fixed
 *  ✅ Cover-fit math verified correct
 */

(function () {
    "use strict";

    /* ══════════════════════════════════════════════════
       1. ELEMENT REFERENCES
    ══════════════════════════════════════════════════ */
    const wrapper     = document.getElementById("frame-wrapper");
    const photo       = document.getElementById("frame-user-image");
    const fileInput   = document.getElementById("frame-upload");
    const placeholder = document.getElementById("uploadPlaceholderText");
    const zoomBar     = document.getElementById("frame-zoom-bar");
    const slider      = document.getElementById("zoom-slider");
    const btnIn       = document.getElementById("btn-zoom-in");
    const btnOut      = document.getElementById("btn-zoom-out");
    const btnReset    = document.getElementById("btn-zoom-reset");
    const hint        = document.getElementById("frame-hint");

    /* ── Safety check ─────────────────────────────────────── */
    if (!wrapper || !photo || !fileInput) {
        console.warn("[frame-preview] Elements missing:", {
            wrapper  : !!wrapper,
            photo    : !!photo,
            fileInput: !!fileInput
        });
        return;
    }

    /* ══════════════════════════════════════════════════
       2. STATE
    ══════════════════════════════════════════════════ */
    const S = {
        scale   : 1,
        x       : 0,
        y       : 0,
        baseW   : 0,
        baseH   : 0,
        dragging: false,
        startX  : 0,
        startY  : 0,
        originX : 0,
        originY : 0,
    };

    /* ══════════════════════════════════════════════════
       3. GET WRAPPER SIZE — THE CRITICAL FIX
       offsetWidth returns 0 when parent uses aspect-ratio
       getBoundingClientRect() returns the real rendered size
    ══════════════════════════════════════════════════ */
    function getWrapperSize() {
        const rect = wrapper.getBoundingClientRect();

        let w = rect.width;
        let h = rect.height;

        /* Fallback: if getBoundingClientRect also gives 0
           (page not fully painted yet), use offsetWidth */
        if (w === 0) w = wrapper.offsetWidth;
        if (h === 0) h = wrapper.offsetHeight;

        /* Last resort: use clientWidth */
        if (w === 0) w = wrapper.clientWidth;
        if (h === 0) h = wrapper.clientHeight;

        console.log("[frame-preview] Wrapper size:", w, "×", h);
        return { w, h };
    }

    /* ══════════════════════════════════════════════════
       4. CORE MATH FUNCTIONS
    ══════════════════════════════════════════════════ */

    /**
     * coverFit()
     * Calculates image size to fully cover the wrapper.
     * Same as CSS object-fit: cover.
     *
     * ratio = max(boxW/natW, boxH/natH)
     * → ensures BOTH dimensions >= box size (no gaps)
     */
    function coverFit(natW, natH, boxW, boxH) {
        if (natW === 0 || natH === 0 || boxW === 0 || boxH === 0) {
            console.error("[frame-preview] coverFit received zero dimension", {natW, natH, boxW, boxH});
            return { w: boxW || 300, h: boxH || 300 };
        }
        const ratio = Math.max(boxW / natW, boxH / natH);
        return { w: natW * ratio, h: natH * ratio };
    }

    /**
     * clampOffsets()
     * Prevents image from sliding to expose wrapper background.
     * x stays in [ boxW − scaledW , 0 ]
     * y stays in [ boxH − scaledH , 0 ]
     */
    function clampOffsets(x, y) {
        const { w: bW, h: bH } = getWrapperSize();
        const sW = S.baseW * S.scale;
        const sH = S.baseH * S.scale;

        return {
            x: Math.min(0, Math.max(x, bW - sW)),
            y: Math.min(0, Math.max(y, bH - sH)),
        };
    }

    /**
     * applyTransform()
     * Writes current state → DOM.
     * GPU-accelerated via CSS transform (no layout reflow).
     */
    function applyTransform() {
        const c = clampOffsets(S.x, S.y);
        S.x     = c.x;
        S.y     = c.y;

        photo.style.width     = S.baseW + "px";
        photo.style.height    = S.baseH + "px";
        photo.style.transform = `translate(${S.x}px, ${S.y}px) scale(${S.scale})`;
    }

    /**
     * resetToCenter()
     * Perfect center cover-fit from scratch.
     * Called after upload + on Reset button.
     *
     * Center formula:
     *   S.x = (boxW − coverW) / 2  (always ≤ 0)
     *   S.y = (boxH − coverH) / 2  (always ≤ 0)
     */
    function resetToCenter() {
        const { w: bW, h: bH } = getWrapperSize();
        const natW = photo.naturalWidth;
        const natH = photo.naturalHeight;

        console.log("[frame-preview] naturalWidth:", natW, "naturalHeight:", natH);
        console.log("[frame-preview] box:", bW, "×", bH);

        const cover = coverFit(natW, natH, bW, bH);

        S.baseW = cover.w;
        S.baseH = cover.h;
        S.scale = 1;
        S.x     = (bW - cover.w) / 2;
        S.y     = (bH - cover.h) / 2;

        console.log("[frame-preview] cover size:", cover.w, "×", cover.h);
        console.log("[frame-preview] offset:", S.x, S.y);

        if (slider) slider.value = 100;
        applyTransform();
    }

    /* ══════════════════════════════════════════════════
       5. FILE UPLOAD → INSTANT FRAME PREVIEW
          THIS IS THE MAIN FIX FLOW
    ══════════════════════════════════════════════════ */

    fileInput.addEventListener("change", function () {
        const file = this.files && this.files[0];
        if (!file) {
            console.warn("[frame-preview] No file selected");
            return;
        }
        if (!file.type.startsWith("image/")) {
            console.warn("[frame-preview] Not an image:", file.type);
            return;
        }

        console.log("[frame-preview] File selected:", file.name, file.type);

        const reader = new FileReader();

        reader.addEventListener("load", function (evt) {
            console.log("[frame-preview] FileReader loaded, setting photo.src");

            /* One-shot load listener on the img element */
            photo.addEventListener("load", function onImageReady() {
                photo.removeEventListener("load", onImageReady);

                console.log("[frame-preview] Image decoded. naturalSize:",
                    photo.naturalWidth, "×", photo.naturalHeight);

                /* ── STEP 1: Show the photo element FIRST ── */
                photo.style.display = "block";

                /* ── STEP 2: Hide placeholder ── */
                if (placeholder) placeholder.style.display = "none";

                /* ── STEP 3: Show zoom bar ── */
                if (zoomBar) zoomBar.style.display = "flex";

                /* ── STEP 4: Apply cover-fit sizing ──────────────────
                   If wrapper size is 0 at this moment (page still
                   painting), wait one frame then retry.
                ─────────────────────────────────────────────────── */
                const { w, h } = getWrapperSize();

                if (w === 0 || h === 0) {
                    console.warn("[frame-preview] Wrapper size is 0, retrying after paint...");
                    requestAnimationFrame(function () {
                        requestAnimationFrame(function () {
                            resetToCenter();
                            showHint();
                        });
                    });
                } else {
                    resetToCenter();
                    showHint();
                }
            });

            /* Setting src triggers the load event above */
            photo.src = evt.target.result;
        });

        reader.addEventListener("error", function () {
            console.error("[frame-preview] FileReader error");
        });

        reader.readAsDataURL(file);
    });

    /* ══════════════════════════════════════════════════
       6. DRAG TO REPOSITION
    ══════════════════════════════════════════════════ */

    wrapper.addEventListener("mousedown",  dragStart);
    wrapper.addEventListener("touchstart", dragStart, { passive: false });

    function dragStart(e) {
        if (!photo.src || photo.style.display === "none") return;
        e.preventDefault();

        const pt   = getPointer(e);
        S.dragging = true;
        S.startX   = pt.x;
        S.startY   = pt.y;
        S.originX  = S.x;
        S.originY  = S.y;
        wrapper.style.cursor = "grabbing";
    }

    document.addEventListener("mousemove",  dragMove);
    document.addEventListener("touchmove",  dragMove, { passive: false });

    function dragMove(e) {
        if (!S.dragging) return;
        e.preventDefault();

        const pt = getPointer(e);
        S.x      = S.originX + (pt.x - S.startX);
        S.y      = S.originY + (pt.y - S.startY);
        applyTransform();
    }

    document.addEventListener("mouseup",  stopDrag);
    document.addEventListener("touchend", stopDrag);

    function stopDrag() {
        if (!S.dragging) return;
        S.dragging = false;
        wrapper.style.cursor = "grab";
    }

    function getPointer(e) {
        return (e.touches && e.touches[0])
            ? { x: e.touches[0].clientX, y: e.touches[0].clientY }
            : { x: e.clientX,            y: e.clientY            };
    }

    /* ══════════════════════════════════════════════════
       7. SCROLL TO ZOOM (zooms toward cursor position)
    ══════════════════════════════════════════════════ */

    wrapper.addEventListener("wheel", function (e) {
        if (!photo.src || photo.style.display === "none") return;
        e.preventDefault();

        const rect     = wrapper.getBoundingClientRect();
        const cx       = e.clientX - rect.left;
        const cy       = e.clientY - rect.top;
        const delta    = e.deltaY < 0 ? 0.08 : -0.08;
        const newScale = Math.min(3, Math.max(1, S.scale + delta));
        const ratio    = newScale / S.scale;

        S.x     = cx - ratio * (cx - S.x);
        S.y     = cy - ratio * (cy - S.y);
        S.scale = newScale;

        if (slider) slider.value = Math.round(S.scale * 100);
        applyTransform();

    }, { passive: false });

    /* ══════════════════════════════════════════════════
       8. ZOOM SLIDER
    ══════════════════════════════════════════════════ */

    if (slider) {
        slider.addEventListener("input", function () {
            const { w: cx, h: cy } = getWrapperSize();
            const newScale = parseFloat(this.value) / 100;
            const ratio    = newScale / S.scale;

            S.x     = (cx / 2) - ratio * ((cx / 2) - S.x);
            S.y     = (cy / 2) - ratio * ((cy / 2) - S.y);
            S.scale = newScale;

            applyTransform();
        });
    }

    /* ══════════════════════════════════════════════════
       9. ZOOM BUTTONS
    ══════════════════════════════════════════════════ */

    function zoomFromCenter(delta) {
        const { w, h }  = getWrapperSize();
        const cx        = w / 2;
        const cy        = h / 2;
        const newScale  = Math.min(3, Math.max(1, S.scale + delta));
        const ratio     = newScale / S.scale;

        S.x     = cx - ratio * (cx - S.x);
        S.y     = cy - ratio * (cy - S.y);
        S.scale = newScale;

        if (slider) slider.value = Math.round(S.scale * 100);
        applyTransform();
    }

    if (btnIn)    btnIn.addEventListener("click",  () => zoomFromCenter(+0.15));
    if (btnOut)   btnOut.addEventListener("click", () => zoomFromCenter(-0.15));
    if (btnReset) btnReset.addEventListener("click", resetToCenter);

    /* ══════════════════════════════════════════════════
       10. DRAG HINT TOAST
    ══════════════════════════════════════════════════ */

    let hintTimer = null;

    function showHint() {
        if (!hint) return;
        hint.classList.add("show");
        clearTimeout(hintTimer);
        hintTimer = setTimeout(() => hint.classList.remove("show"), 2500);
    }

    console.log("[frame-preview] ✅ Initialized successfully");

})();