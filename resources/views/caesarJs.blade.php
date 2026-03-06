<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caesar Cipher App</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Orbitron:wght@400;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: #0a0a0f;
            color: #00ff88;
            font-family: 'Share Tech Mono', monospace;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px 20px;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(0,255,136,0.05) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(0,150,255,0.05) 0%, transparent 60%);
        }

        body::after {
            content: '';
            position: fixed;
            top: -1%; left: 0;
            width: 100%; height: 3px;
            background: rgba(0,255,136,0.08);
            animation: bodyScan 6s linear infinite;
            pointer-events: none;
        }

        @keyframes bodyScan {
            0%   { top: -1%; }
            100% { top: 101%; }
        }

        h1 {
            font-family: 'Orbitron', monospace;
            font-size: 1.8rem;
            text-align: center;
            letter-spacing: 4px;
            color: #00ff88;
            text-shadow: 0 0 20px #00ff88, 0 0 40px #00ff8855;
            margin-bottom: 4px;
        }

        .subtitle {
            color: #00aaffaa;
            text-align: center;
            font-size: 0.75rem;
            letter-spacing: 3px;
            margin-bottom: 24px;
        }

        /* ── Main horizontal layout ── */
        .layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            width: 100%;
            max-width: 1100px;
            align-items: start;
        }

        .card {
            background: rgba(255,255,255,0.03);
            border: 1px solid #00ff8833;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 0 40px #00ff8811, inset 0 0 40px #00000033;
            backdrop-filter: blur(10px);
        }

        .card-title {
            font-family: 'Orbitron', monospace;
            font-size: 0.7rem;
            letter-spacing: 3px;
            color: #00aaffaa;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #00ff8822;
        }

        label {
            display: block;
            font-size: 0.7rem;
            letter-spacing: 2px;
            color: #00aaffcc;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        textarea, input[type=number], select {
            width: 100%;
            background: rgba(0,0,0,0.5);
            border: 1px solid #00ff8844;
            border-radius: 8px;
            color: #00ff88;
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.95rem;
            padding: 10px 12px;
            margin-bottom: 18px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
            resize: none;
        }

        textarea { min-height: 90px; }

        textarea:focus, input:focus, select:focus {
            border-color: #00ff88;
            box-shadow: 0 0 12px #00ff8844;
        }

        select option { background: #0d1117; }

        /* Shift + Mode row */
        .row-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .row-2col label { margin-bottom: 6px; }
        .row-2col input,
        .row-2col select { margin-bottom: 0; }

        .shift-display {
            text-align: center;
            font-family: 'Orbitron', monospace;
            font-size: 2rem;
            color: #00ff88;
            text-shadow: 0 0 20px #00ff88;
            margin: 16px 0;
            letter-spacing: 4px;
        }

        .shift-display span { color: #00aaff; }

        /* Button */
        .btn-process {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #00ff8822, #00aaff22);
            border: 1px solid #00ff88;
            border-radius: 10px;
            color: #00ff88;
            font-family: 'Orbitron', monospace;
            font-size: 0.9rem;
            letter-spacing: 3px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            margin-top: 18px;
        }

        .btn-process::before {
            content: '';
            position: absolute;
            top: -100%; left: -100%;
            width: 300%; height: 300%;
            background: linear-gradient(135deg, transparent, rgba(0,255,136,0.1), transparent);
            transition: all 0.5s;
        }

        .btn-process:hover::before { top: 100%; left: 100%; }

        .btn-process:hover {
            background: linear-gradient(135deg, #00ff8844, #00aaff44);
            box-shadow: 0 0 20px #00ff8866;
            color: #fff;
        }

        .btn-process:disabled { opacity: 0.6; cursor: not-allowed; }

        /* Loading bar */
        .loading-bar {
            height: 3px;
            background: linear-gradient(90deg, transparent, #00ff88, #00aaff, transparent);
            background-size: 200% 100%;
            border-radius: 2px;
            margin-top: 10px;
            display: none;
            animation: shimmer 1s linear infinite;
        }

        .loading-bar.active { display: block; }

        @keyframes shimmer {
            0%   { background-position: -200% 0; }
            100% { background-position:  200% 0; }
        }

        /* ── Right column ── */
        .right-col {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* Alphabet Visualizer */
        .alphabet-visualizer {
            background: rgba(0,0,0,0.4);
            border: 1px solid #00ff8833;
            border-radius: 10px;
            padding: 12px 8px;
        }

        .alpha-label {
            font-size: 0.6rem;
            letter-spacing: 2px;
            color: #ffffff44;
            text-align: center;
            margin-bottom: 6px;
        }

        .alpha-row {
            display: flex;
            justify-content: center;
            gap: 3px;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .alpha-row::-webkit-scrollbar { display: none; }

        .alpha-cell {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            border-radius: 4px;
            border: 1px solid #ffffff11;
            background: rgba(255,255,255,0.03);
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .alpha-cell.original { color: #ffffff88; }

        .alpha-cell.shifted {
            color: #00ff88;
            border-color: #00ff8844;
            background: rgba(0,255,136,0.08);
        }

        .alpha-cell.highlight {
            background: rgba(0,255,136,0.25);
            border-color: #00ff88;
            color: #fff;
            text-shadow: 0 0 8px #00ff88;
            transform: scale(1.2);
        }

        .shift-arrow {
            text-align: center;
            font-size: 1rem;
            color: #00aaff;
            margin: 4px 0;
        }

        /* Result Box */
        .result-box {
            background: rgba(0,255,136,0.04);
            border: 1px solid #00ff8833;
            border-radius: 12px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            min-height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .result-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00ff88, #00aaff, transparent);
            animation: scanline 2s linear infinite;
        }

        .result-box.error { border-color: #ff4466; background: rgba(255,68,102,0.05); }
        .result-box.error::before { background: linear-gradient(90deg, transparent, #ff4466, transparent); }

        .result-box.pop { animation: fadeInUp 0.4s ease; }

        @keyframes scanline {
            0%   { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .result-label {
            font-size: 0.65rem;
            letter-spacing: 3px;
            color: #00aaffcc;
            margin-bottom: 10px;
        }

        .result-placeholder {
            font-size: 0.8rem;
            color: #ffffff22;
            text-align: center;
            letter-spacing: 2px;
        }

        .result-text {
            font-size: 1.1rem;
            color: #fff;
            word-break: break-all;
            text-shadow: 0 0 10px #00ff8888;
            min-height: 1.4em;
            display: none;
        }

        .result-text.show { display: block; }

        .cursor {
            display: inline-block;
            width: 7px;
            height: 1em;
            background: #00ff88;
            animation: blink 1s step-end infinite;
            vertical-align: text-bottom;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0; }
        }

        /* Copy button */
        .btn-copy {
            align-self: flex-start;
            margin-top: 12px;
            padding: 5px 14px;
            background: transparent;
            border: 1px solid #00ff8866;
            border-radius: 6px;
            color: #00ff88;
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.7rem;
            cursor: pointer;
            letter-spacing: 1px;
            transition: all 0.3s;
            display: none;
        }

        .btn-copy.show { display: inline-block; }

        .btn-copy:hover {
            background: rgba(0,255,136,0.1);
            border-color: #00ff88;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .layout { grid-template-columns: 1fr; }
            h1 { font-size: 1.4rem; }
        }
    </style>
</head>
<body>

<h1>CAESAR CIPHER</h1>
<p class="subtitle">// ENCRYPTION &amp; DECRYPTION TERMINAL //</p>

<div class="layout">

    <!-- LEFT: Form Input -->
    <div class="card">
        <div class="card-title">▸ INPUT PANEL</div>
        <form id="cipherForm">

            <label>Input Text</label>
            <textarea id="inputText" placeholder="Masukkan teks di sini..."></textarea>

            <div class="row-2col">
                <div>
                    <label>Shift Value (1–25)</label>
                    <input type="number" id="shiftInput" min="1" max="25" value="3">
                </div>
                <div>
                    <label>Mode</label>
                    <select id="modeSelect">
                        <option value="encrypt">🔒 Encrypt</option>
                        <option value="decrypt">🔓 Decrypt</option>
                    </select>
                </div>
            </div>

            <div class="shift-display">SHIFT : <span id="shiftVal">3</span></div>

            <button type="submit" class="btn-process" id="submitBtn">⚙ PROSES</button>
            <div class="loading-bar" id="loadingBar"></div>
        </form>
    </div>

    <!-- RIGHT: Visualizer + Result -->
    <div class="right-col">

        <!-- Alphabet Visualizer -->
        <div class="card">
            <div class="card-title">▸ SHIFT VISUALIZER</div>
            <div class="alphabet-visualizer">
                <div class="alpha-label">ORIGINAL ALPHABET</div>
                <div class="alpha-row" id="rowOriginal"></div>
                <div class="shift-arrow">↓ &nbsp; SHIFT <span id="arrowShiftVal">3</span> &nbsp; ↓</div>
                <div class="alpha-label">SHIFTED ALPHABET</div>
                <div class="alpha-row" id="rowShifted"></div>
            </div>
        </div>

        <!-- Result -->
        <div class="card result-box" id="resultBox">
            <div class="result-label" id="resultLabel">▸ HASIL OUTPUT</div>
            <div class="result-placeholder" id="resultPlaceholder">[ WAITING FOR INPUT ]</div>
            <div class="result-text" id="resultOutput"></div>
            <button class="btn-copy" id="btnCopy" onclick="copyResult()">⎘ COPY</button>
        </div>

    </div>
</div>

<script>
    const alphabet      = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const shiftInput    = document.getElementById('shiftInput');
    const shiftVal      = document.getElementById('shiftVal');
    const arrowShiftVal = document.getElementById('arrowShiftVal');
    const inputText     = document.getElementById('inputText');
    const rowOriginal   = document.getElementById('rowOriginal');
    const rowShifted    = document.getElementById('rowShifted');
    const resultBox     = document.getElementById('resultBox');
    const resultOutput  = document.getElementById('resultOutput');
    const resultPlaceholder = document.getElementById('resultPlaceholder');
    const loadingBar    = document.getElementById('loadingBar');
    const submitBtn     = document.getElementById('submitBtn');
    const resultLabel   = document.getElementById('resultLabel');
    const btnCopy       = document.getElementById('btnCopy');

    // ── Build alphabet rows ──
    function buildAlphabetRows(shift) {
        rowOriginal.innerHTML = '';
        rowShifted.innerHTML  = '';
        shift = ((shift % 26) + 26) % 26;

        alphabet.split('').forEach((ch, i) => {
            const orig = document.createElement('div');
            orig.classList.add('alpha-cell', 'original');
            orig.textContent = ch;
            rowOriginal.appendChild(orig);

            const shifted = document.createElement('div');
            shifted.classList.add('alpha-cell', 'shifted');
            shifted.textContent = alphabet[(i + shift) % 26];
            rowShifted.appendChild(shifted);
        });
    }

    // ── Update shift ──
    function updateShift() {
        const val = parseInt(shiftInput.value) || 1;
        shiftVal.textContent      = val;
        arrowShiftVal.textContent = val;
        buildAlphabetRows(val);

        // Highlight ulang huruf terakhir setelah rebuild
        const letters = inputText.value.replace(/[^a-zA-Z]/g, '');
        if (letters.length > 0) {
            highlightChar(letters[letters.length - 1].toUpperCase());
        }
    }

    shiftInput.addEventListener('input', updateShift);

    // ── Highlight animasi saat mengetik ──
    let typingTimeout;
    inputText.addEventListener('input', () => {
        clearTimeout(typingTimeout);
        const letters = inputText.value.replace(/[^a-zA-Z]/g, '');
        let idx = 0;
        clearHighlights();

        function animateNext() {
            if (idx >= letters.length) return;
            clearHighlights();
            highlightChar(letters[idx].toUpperCase());
            idx++;
            typingTimeout = setTimeout(animateNext, 80);
        }
        animateNext();
    });

    function clearHighlights() {
        document.querySelectorAll('.alpha-cell').forEach(c => c.classList.remove('highlight'));
    }

    function highlightChar(ch) {
        const origIdx = alphabet.indexOf(ch);
        if (origIdx === -1) return;
        rowOriginal.querySelectorAll('.alpha-cell')[origIdx]?.classList.add('highlight');
        rowShifted.querySelectorAll('.alpha-cell')[origIdx]?.classList.add('highlight');
    }

    // ── Typewriter effect ──
    let typewriterTimer;
    function typeWriter(text, isError = false) {
        clearInterval(typewriterTimer);
        resultOutput.innerHTML = '';
        resultOutput.classList.add('show');
        resultPlaceholder.style.display = 'none';
        btnCopy.classList.add('show');

        resultBox.classList.remove('error', 'pop');
        void resultBox.offsetWidth; // reflow untuk restart animasi
        resultBox.classList.add('pop');
        if (isError) resultBox.classList.add('error');

        let i = 0;
        typewriterTimer = setInterval(() => {
            if (i < text.length) {
                resultOutput.innerHTML = text.substring(0, i + 1) + '<span class="cursor"></span>';
                i++;
            } else {
                resultOutput.innerHTML = text;
                clearInterval(typewriterTimer);
            }
        }, 40);
    }

    // ── Copy ──
    function copyResult() {
        navigator.clipboard.writeText(resultOutput.textContent).then(() => {
            btnCopy.textContent = '✔ COPIED!';
            setTimeout(() => btnCopy.textContent = '⎘ COPY', 2000);
        });
    }

    // ── AJAX Submit ──
    document.getElementById('cipherForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const text  = inputText.value.trim();
        const shift = shiftInput.value;
        const mode  = document.getElementById('modeSelect').value;

        if (!text) return;

        submitBtn.disabled    = true;
        submitBtn.textContent = '⚙ MEMPROSES...';
        loadingBar.classList.add('active');

        fetch('/caesar-process-json', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    ?? '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ text, shift, mode }),
        })
            .then(res => {
                if (!res.ok) throw new Error('Server error: ' + res.status);
                return res.json();
            })
            .then(data => {
                resultLabel.textContent = mode === 'encrypt' ? '▸ 🔒 HASIL ENKRIPSI' : '▸ 🔓 HASIL DEKRIPSI';
                typeWriter(data.result);
            })
            .catch(err => {
                resultLabel.textContent = '▸ ⚠ ERROR';
                typeWriter(err.message, true);
            })
            .finally(() => {
                submitBtn.disabled    = false;
                submitBtn.textContent = '⚙ PROSES';
                loadingBar.classList.remove('active');
            });
    });

    // Init
    buildAlphabetRows(3);
</script>
</body>
</html>
