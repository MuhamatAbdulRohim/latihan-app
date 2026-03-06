<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caesar Cipher App</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Orbitron:wght@400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a0a0f;
            color: #00ff88;
            font-family: 'Share Tech Mono', monospace;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(0,255,136,0.05) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(0,150,255,0.05) 0%, transparent 60%);
        }

        h1 {
            font-family: 'Orbitron', monospace;
            font-size: 2rem;
            text-align: center;
            letter-spacing: 4px;
            color: #00ff88;
            text-shadow: 0 0 20px #00ff88, 0 0 40px #00ff8855;
            margin-bottom: 6px;
        }

        .subtitle {
            color: #00aaffaa;
            text-align: center;
            font-size: 0.8rem;
            letter-spacing: 3px;
            margin-bottom: 40px;
        }

        .card {
            background: rgba(255,255,255,0.03);
            border: 1px solid #00ff8833;
            border-radius: 16px;
            padding: 36px;
            width: 100%;
            max-width: 640px;
            box-shadow: 0 0 40px #00ff8811, inset 0 0 40px #00000033;
            backdrop-filter: blur(10px);
        }

        label {
            display: block;
            font-size: 0.75rem;
            letter-spacing: 2px;
            color: #00aaffcc;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        textarea, input[type=number], select {
            width: 100%;
            background: rgba(0,0,0,0.5);
            border: 1px solid #00ff8844;
            border-radius: 8px;
            color: #00ff88;
            font-family: 'Share Tech Mono', monospace;
            font-size: 1rem;
            padding: 12px 14px;
            margin-bottom: 24px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
            resize: vertical;
        }

        textarea { min-height: 100px; }

        textarea:focus, input:focus, select:focus {
            border-color: #00ff88;
            box-shadow: 0 0 12px #00ff8844;
        }

        select option {
            background: #0d1117;
        }

        .shift-display {
            text-align: center;
            font-family: 'Orbitron', monospace;
            font-size: 2.5rem;
            color: #00ff88;
            text-shadow: 0 0 20px #00ff88;
            margin-bottom: 24px;
            letter-spacing: 4px;
        }

        .shift-display span {
            color: #00aaff;
        }

        /* ── Alphabet Shift Visualizer ── */
        .alphabet-visualizer {
            background: rgba(0,0,0,0.5);
            border: 1px solid #00ff8833;
            border-radius: 10px;
            padding: 14px 10px;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .alpha-label {
            font-size: 0.65rem;
            letter-spacing: 2px;
            color: #ffffff44;
            text-align: center;
            margin-bottom: 6px;
        }

        .alpha-row {
            display: flex;
            justify-content: center;
            gap: 4px;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .alpha-cell {
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            border-radius: 4px;
            border: 1px solid #ffffff11;
            background: rgba(255,255,255,0.03);
            transition: all 0.4s ease;
            flex-shrink: 0;
        }

        .alpha-cell.original {
            color: #ffffff88;
        }

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
            transform: scale(1.15);
            z-index: 1;
        }

        /* ── Arrow Animation ── */
        .shift-arrow {
            text-align: center;
            font-size: 1.2rem;
            color: #00aaff;
            margin: 4px 0 6px;
            letter-spacing: 1px;
            min-height: 24px;
            transition: opacity 0.3s;
        }

        /* ── Submit Button ── */
        .btn-process {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #00ff8822, #00aaff22);
            border: 1px solid #00ff88;
            border-radius: 10px;
            color: #00ff88;
            font-family: 'Orbitron', monospace;
            font-size: 1rem;
            letter-spacing: 3px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-process::before {
            content: '';
            position: absolute;
            top: -100%;
            left: -100%;
            width: 300%;
            height: 300%;
            background: linear-gradient(135deg, transparent, rgba(0,255,136,0.1), transparent);
            transition: all 0.5s;
        }

        .btn-process:hover::before {
            top: 100%;
            left: 100%;
        }

        .btn-process:hover {
            background: linear-gradient(135deg, #00ff8844, #00aaff44);
            box-shadow: 0 0 20px #00ff8866;
            color: #fff;
        }

        .btn-process:active {
            transform: scale(0.98);
        }

        /* ── Loading Animation ── */
        .loading-bar {
            height: 3px;
            background: linear-gradient(90deg, transparent, #00ff88, #00aaff, transparent);
            border-radius: 2px;
            margin-top: 14px;
            width: 0%;
            transition: width 0.8s ease;
            display: none;
        }

        .loading-bar.active {
            display: block;
            width: 100%;
        }

        /* ── Result Box ── */
        .result-box {
            margin-top: 30px;
            padding: 20px;
            background: rgba(0,255,136,0.05);
            border: 1px solid #00ff8866;
            border-radius: 12px;
            animation: fadeInUp 0.6s ease;
            position: relative;
            overflow: hidden;
        }

        .result-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00ff88, #00aaff, transparent);
            animation: scanline 2s linear infinite;
        }

        @keyframes scanline {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .result-label {
            font-size: 0.7rem;
            letter-spacing: 3px;
            color: #00aaffcc;
            margin-bottom: 10px;
        }

        .result-text {
            font-size: 1.2rem;
            color: #fff;
            word-break: break-all;
            text-shadow: 0 0 10px #00ff8888;
        }

        /* ── Scan line on body ── */
        body::after {
            content: '';
            position: fixed;
            top: -100%;
            left: 0;
            width: 100%;
            height: 3px;
            background: rgba(0,255,136,0.08);
            animation: bodyScan 6s linear infinite;
            pointer-events: none;
        }

        @keyframes bodyScan {
            0%   { top: -1%; }
            100% { top: 101%; }
        }

        /* ── Blinking cursor ── */
        .cursor {
            display: inline-block;
            width: 8px;
            height: 1em;
            background: #00ff88;
            animation: blink 1s step-end infinite;
            vertical-align: text-bottom;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0; }
        }
    </style>
</head>
<body>

<h1>CAESAR CIPHER</h1>
<p class="subtitle">// ENCRYPTION &amp; DECRYPTION TERMINAL //</p>

<div class="card">
    <form action="/caesar-process" method="POST" id="cipherForm">
        @csrf

        <label>▸ Input Text</label>
        <textarea name="text" id="inputText" required placeholder="Masukkan teks di sini..."></textarea>

        <label>▸ Shift Value (1–25)</label>
        <input type="number" name="shift" id="shiftInput" min="1" max="25" value="3" required>

        <div class="shift-display" id="shiftDisplay">
            SHIFT : <span id="shiftVal">3</span>
        </div>

        <!-- Alphabet Visualizer -->
        <div class="alphabet-visualizer">
            <div class="alpha-label">ORIGINAL ALPHABET</div>
            <div class="alpha-row" id="rowOriginal"></div>

            <div class="shift-arrow" id="shiftArrow">↓ &nbsp; SHIFT <span id="arrowShiftVal">3</span> &nbsp; ↓</div>

            <div class="alpha-label">SHIFTED ALPHABET</div>
            <div class="alpha-row" id="rowShifted"></div>
        </div>

        <label>▸ Mode</label>
        <select name="mode" id="modeSelect">
            <option value="encrypt">🔒 Encrypt</option>
            <option value="decrypt">🔓 Decrypt</option>
        </select>

        <button type="submit" class="btn-process" id="submitBtn">⚙ PROSES</button>
        <div class="loading-bar" id="loadingBar"></div>
    </form>

    @if(session('result'))
        <div class="result-box">
            <div class="result-label">▸ HASIL OUTPUT</div>
            <div class="result-text" id="resultOutput"></div>
        </div>

        <script>
            // Typewriter effect untuk hasil
            const resultText = @json(session('result'));
            const el = document.getElementById('resultOutput');
            let i = 0;
            function typeWriter() {
                if (i < resultText.length) {
                    el.innerHTML = resultText.substring(0, i + 1) + '<span class="cursor"></span>';
                    i++;
                    setTimeout(typeWriter, 40);
                } else {
                    el.innerHTML = resultText;
                }
            }
            typeWriter();
        </script>
    @endif
</div>

<script>
    const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const rowOriginal = document.getElementById('rowOriginal');
    const rowShifted  = document.getElementById('rowShifted');
    const shiftInput  = document.getElementById('shiftInput');
    const shiftVal    = document.getElementById('shiftVal');
    const arrowShiftVal = document.getElementById('arrowShiftVal');
    const inputText   = document.getElementById('inputText');

    // Build alphabet rows
    function buildAlphabetRows(shift, highlightChar) {
        rowOriginal.innerHTML = '';
        rowShifted.innerHTML  = '';
        shift = ((shift % 26) + 26) % 26;

        alphabet.split('').forEach((ch, i) => {
            const orig = document.createElement('div');
            orig.classList.add('alpha-cell', 'original');
            orig.textContent = ch;
            if (highlightChar && ch === highlightChar.toUpperCase()) {
                orig.classList.add('highlight');
            }
            rowOriginal.appendChild(orig);

            const shifted = document.createElement('div');
            shifted.classList.add('alpha-cell', 'shifted');
            const shiftedCh = alphabet[(i + shift) % 26];
            shifted.textContent = shiftedCh;
            if (highlightChar && ch === highlightChar.toUpperCase()) {
                shifted.classList.add('highlight');
            }
            rowShifted.appendChild(shifted);
        });
    }

    // Update display saat shift berubah
    function updateShift() {
        const val = parseInt(shiftInput.value) || 1;
        shiftVal.textContent    = val;
        arrowShiftVal.textContent = val;
        buildAlphabetRows(val, getLastLetter());
    }

    // Ambil huruf terakhir dari input teks
    function getLastLetter() {
        const text = inputText.value.replace(/[^a-zA-Z]/g, '');
        return text.length > 0 ? text[text.length - 1] : null;
    }

    // Animasi highlight bergerak saat mengetik
    let typingTimeout;
    inputText.addEventListener('input', () => {
        clearTimeout(typingTimeout);
        const letters = inputText.value.replace(/[^a-zA-Z]/g, '');
        let idx = 0;
        clearHighlights();

        function animateNext() {
            if (idx >= letters.length) return;
            const ch = letters[idx].toUpperCase();
            clearHighlights();
            highlightChar(ch);
            idx++;
            typingTimeout = setTimeout(animateNext, 80);
        }
        animateNext();
    });

    function clearHighlights() {
        document.querySelectorAll('.alpha-cell').forEach(c => c.classList.remove('highlight'));
    }

    function highlightChar(ch) {
        const cells = rowOriginal.querySelectorAll('.alpha-cell');
        cells.forEach(c => {
            if (c.textContent === ch) c.classList.add('highlight');
        });
        const shiftedCells = rowShifted.querySelectorAll('.alpha-cell');
        const shift = ((parseInt(shiftInput.value) % 26) + 26) % 26;
        const origIdx = alphabet.indexOf(ch);
        if (origIdx !== -1) {
            shiftedCells[origIdx]?.classList.add('highlight');
        }
    }

    shiftInput.addEventListener('input', updateShift);

    // Loading animation saat submit
    document.getElementById('cipherForm').addEventListener('submit', function () {
        const bar = document.getElementById('loadingBar');
        const btn = document.getElementById('submitBtn');
        bar.classList.add('active');
        btn.textContent = '⚙ MEMPROSES...';
        btn.style.opacity = '0.7';
    });

    // Init
    buildAlphabetRows(3, null);
</script>

</body>
</html>
