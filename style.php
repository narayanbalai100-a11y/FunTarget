/* पेज को पूरी तरह लॉक करने के लिए CSS */
* {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    touch-action: manipulation;
}

input, textarea {
    -webkit-user-select: text;
    -moz-user-select: text;
    -ms-user-select: text;
    user-select: text;
}

body, html {
    overscroll-behavior: none;
    -webkit-overflow-scrolling: touch;
    overflow: hidden;
}

:root {
    --neon-green: #39ff14;
    --gold-orange: #ff8c00;
    --pure-white: #ffffff;
    --logout-red: #ff3333;
    --border-wood: #4a2c1d;
    --modal-bg: rgba(0, 0, 0, 0.9);
}

* { 
    margin: 0; 
    padding: 0; 
    box-sizing: border-box; 
    font-family: 'Arial Black', sans-serif; 
}

body, 
html { 
    width: 100%; 
    height: 100%; 
    background-color: #000; 
    overflow: hidden; 
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

#loginSection {
    width: 100vw; 
    height: 100vh;
    background: var(--bg-login) no-repeat center center; 
    background-size: 100% 100%;
    position: fixed; 
    top: 0; 
    left: 0; 
    z-index: 10000; 
    display: flex;
    touch-action: none;
}

.response-header { 
    position: absolute; 
    top: 1.2%; 
    left: 16%; 
    font-size: 1.4vw; 
    font-weight: bold; 
    color: #000000;
    color: #d4b000;
    text-shadow: 2px 2px #000; 
}

/* NEW: Header Blink Animation */
.header-blink {
    animation: headerBlinkEffect 0.5s ease-in-out 5;
}

@keyframes headerBlinkEffect {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}

.input-area { 
    position: absolute; 
    top: 79.4%; 
    left: 30%; 
    display: flex; 
    flex-direction: column; 
    gap: 2vw; 
}

.gk-input { 
    width: 11.5vw; 
    height: 2.2vw; 
    
    border: none;     
    outline: none;    
    background: transparent;
    
    font-weight: bold; 
    font-size: 1.3vw; 
    padding: 0 10px; 
    outline: none; 
    -webkit-user-select: text;
    -moz-user-select: text;
    -ms-user-select: text;
    user-select: text;
}

/* ENTER बटन - इमेज के लिए अपडेट किया गया */
.btn-enter-visual { 
    position: absolute; 
    bottom: 0%; 
    left: 47%; /* बायीं तरफ */
    width: 11vw; 
    height: 5.5vw; 
    cursor: pointer; 
    border: none;     
    outline: none;    
    background: transparent;
    
    font-size: 0vw; 
    font-weight: bold; 
    border-radius: 10px; 
    display: flex; 
    justify-content: center; 
    align-items: center; 
    text-shadow: 2px 2px #000; 
    -webkit-tap-highlight-color: transparent;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

/* क्लिक करने पर एंटर इमेज दिखाना */
.btn-enter-visual.enter-clicked {
    background-image: var(--bg-enter);
}

/* CLOSE बटन - अपडेट किया गया */
.btn-close-visual { 
    position: absolute; 
    bottom: 0%; 
    left: 72.9%; 
    width: 13vw; 
    height: 16vw; 
    cursor: pointer; 
    background: transparent;
    outline: none;    
    border: none;
    display: flex; 
    justify-content: center; 
    align-items: center; 
    overflow: hidden;
    -webkit-tap-highlight-color: transparent;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

/* क्लिक करने पर इमेज दिखाना */
.btn-close-visual.clicked {
    background-image: var(--bg-close);
}

.btn-close-visual::before {
    content: "";
    position: absolute;
    width: 100%;        
    height: 118%;
}

#homeSection {
    width: 100vw; 
    height: 100vh;
    background: var(--bg-home) no-repeat center center; 
    background-size: 100% 100%; 
    position: relative; 
    display: none; 
    z-index: 9000;
    touch-action: none;
}

/* --- New Points Selector UI Styles --- */
.points-selector-container {
    position: absolute;
    top: 7%;
    left: 5.2%;
    display: flex;
    gap: 55px;
    z-index: 9005;
}

.option input[type="radio"] {
    display: none;
}

.option label {
    display: flex;
    align-items: center;
    cursor: pointer;
    color: #4CAF50; /* हरा टेक्स्ट */
    font-size: 1.2vw;
    font-weight: bold;
    text-shadow: 1px 1px 3px #000;
}

.circle {
    height: 1.2vw;
    width: 1.2vw;
    border: 2px solid #aaa;
    border-radius: 50%;
    margin-right: 8px;
    display: inline-block;
    background: #222;
    transition: all 0.3s ease;
    position: relative;
}

.option input[type="radio"]:checked + label .circle {
    background-color: #00bfff; /* गहरा नीला */
    border-color: #e0f7fa; 
    box-shadow: 0 0 10px #00e5ff, inset 0 0 5px #fff;
}

.option input[type="radio"]:checked + label .circle::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 0.5vw;
    height: 0.5vw;
    border-radius: 50%;
    background: white;
}
/* --- End New Styles --- */

.top-nav { 
    position: absolute; 
    top: 1.2%; 
    width: 100%; 
    display: flex; 
    padding: 0 3%; 
    font-size: 1.5vw; 
}

.id-label { 
    position: relative;   /* जरूरी */
    color: var(--gold-orange); 
    left: 125px;   /* दाईं तरफ */
    top: 2.1px;     /* नीचे */
}

.points-label { 
    position: relative;   /* जरूरी */
    color: var(--gold-orange); 
    left: 270px;   /* दाईं तरफ */
    top: 2.1px;     /* नीचे */
}

.dynamic-val { 
    color: var(--pure-white); 
    margin-left: 10px; 
}

.game-header { 
    position: absolute; 
    top: 10%; 
    left: 80%; 
    transform: translateX(-50%); 
    color: var(--gold-orange); 
    font-size: 0vw; 
    font-weight: bold; 
    text-shadow: 2px 2px #000; 
    text-transform: uppercase; 
}

.fun-target-box { 
    position: absolute; 
    top: 11.4%; 
    left: 88%; 
    
    cursor: pointer; 
    opacity: 0;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1vw; 
    
    cursor: pointer; 
    z-index: 9500; 
    -webkit-tap-highlight-color: rgba(57, 255, 20, 0.0);
}

.child-reg-container { 
    position: absolute; 
    top: 20%; 
    left: 52.5%; 
    transform: translateX(-50%); 
    text-align: center; 
    cursor: pointer; 
    opacity: 0;
    background: transparent;
    border: none;
    outline: none;
}

.child-reg-text { 
    color: var(--neon-green); 
    font-size: 2.3vw; 
    font-weight: bold; 
    line-height: 1.1; 
    text-transform: uppercase; 
    display: flex;
}

/* New style for point transfer image */
.point-transfer-image {
    position: absolute;
    top: 48.5%;
    left: 52.3%;
    transform: translateX(-50%);
    text-align: center;
    z-index: 9001;
    cursor: pointer;
    background: transparent;
    border: none;
    outline: none;
}

.point-transfer-image img {
    width: 135px;
    height: auto;
    cursor: pointer;
    animation: blinkEffect 0.3s infinite;
    animation-duration: 0.3s;
    animation-iteration-count: 30; /* 0.3s × 30 = 30 seconds */
}

@keyframes blinkEffect {
    0%   { opacity: 1; }
    50%  { opacity: 0; }
    100% { opacity: 1; }
}

/* बिलिंग टाइमर स्टाइल */
.billing-timer {
    position: absolute;
    top: 45%;
    left: 52.5%;
    transform: translateX(-50%);
    text-align: center;
    z-index: 9002;
    color: #ffd700;
    font-size: 24px;
    font-weight: bold;
    text-shadow: 2px 2px 4px #000;
    display: none;
}

.panel-action-bar { 
    position: absolute; 
    top: 61%; 
    width: 90%; 
    display: flex; 
    justify-content: space-between; 
    padding: 0 5% 0 10.5%; 
    font-size: 0vw; 
    cursor: pointer; 
}

.label-green { 
    color: var(--neon-green); 
    font-style: italic; 
    font-weight: bold; 
    cursor: pointer; 
    border: none;     
    outline: none;    
    background: transparent;
}

.btn-orange { 
    color: var(--gold-orange); 
    cursor: pointer; 
    font-weight: bold; 
    -webkit-tap-highlight-color: rgba(255, 140, 0, 0.3);
    cursor: pointer; 
    border: none;     
    outline: none;    
    background: transparent;
}

.footer-links { 
    position: absolute; 
    bottom: 1.1%; 
    width: 94%; 
    display: flex; 
    justify-content: space-between; 
    padding: 0 3%; 
    cursor: pointer; 
    border: none;     
    outline: none;    
    background: transparent;
}

.refresh-action { 
    color: var(--neon-green); 
    font-size: 0vw; 
    cursor: pointer; 
    font-weight: bold; 
    -webkit-tap-highlight-color: rgba(57, 255, 20, 0.3);
    cursor: pointer; 
    border: none;     
    outline: none;    
    background: transparent;
}

.logout-action { 
    color: var(--logout-red); 
    font-size: 1.5vw; 
    cursor: pointer; 
    font-weight: bold; 
    -webkit-tap-highlight-color: rgba(255, 51, 51, 0.3);
    opacity: 0;
    background: transparent;
    border: none;
    outline: none;
}

#transferModal { 
    display: none; 
    position: fixed; 
    z-index: 50000; 
    left: 0; 
    top: 0; 
    width: 100%; 
    height: 100%; 
    background-color: var(--modal-bg); 
    justify-content: center; 
    align-items: center; 
    touch-action: none;
}

.new-modal-box { 
    width: 550px; 
    background: radial-gradient(circle, #8b0000 0%, #2b0000 100%); 
    border: 2px solid #d2691e; 
    padding: 0; 
    color: #fff; 
}

.m-header { 
    text-align: center; 
    font-size: 22px; 
    padding: 20px 0; 
    font-weight: bold; 
    letter-spacing: 3px; 
}

.m-content { 
    padding: 10px 30px; 
}

.m-row { 
    display: flex; 
    align-items: center; 
    margin-bottom: 20px; 
    text-transform: uppercase; 
}

.m-label { 
    width: 180px; 
    font-weight: bold; 
}

.m-input-field { 
    background: rgba(255, 255, 255, 0.1); 
    border: 1px solid #d2691e; 
    color: #fff; 
    padding: 5px 10px; 
    width: 100%; 
    outline: none; 
    -webkit-user-select: text;
    -moz-user-select: text;
    -ms-user-select: text;
    user-select: text;
}

.m-btn-container { 
    display: flex; 
    justify-content: center; 
    gap: 30px; 
    margin: 20px 0 30px 0; 
}

.m-btn { 
    background: linear-gradient(to bottom, #7d0000 0%, #3a0000 100%); 
    border: 2px solid #fff; 
    border-radius: 25px; 
    color: white; 
    padding: 8px 30px; 
    font-weight: bold; 
    cursor: pointer; 
    text-transform: uppercase; 
    -webkit-tap-highlight-color: rgba(255, 255, 255, 0.3);
}

#gameSection { 
    display: none; 
    width: 100vw; 
    height: 100vh; 
    position: relative; 
    background-color: #000; 
    touch-action: none;
}

.deep-background { 
    position: absolute; 
    width: 100vw; 
    height:100vh; 
    z-index: 50; 
    background: var(--bg-game-deep) no-repeat center center; 
    background-size: 100% 100%; 
    pointer-events: none; 
}

.game-wrapper { 
    position: relative; 
    width: 100vw; 
    height: 100vh; 
    background: var(--bg-game-wrapper) no-repeat center center; 
    background-size: 100% 100%; 
    z-index: 100; 
    pointer-events: none; 
}

.game-wrapper::before {
    content: "";
    position: absolute;
    top: 61%;
    left: 0;
    width: 100%;
    height: 39%;
    background: var(--bg-upper) no-repeat center center;
    background-size: 100% 100%;
    transform: translateY(-50%);
    z-index: 101;
    pointer-events: none;
    animation: softPulseUp 3s infinite ease-in-out;
    transform-origin: center center;
}

@keyframes softPulse {
    0%   { transform: translateY(-50%) scale(0.9995); opacity: 0.985; }
    50%  { transform: translateY(-50%) scale(1.0005); opacity: 1; }
    100% { transform: translateY(-50%) scale(0.9995); opacity: 0.985; }
}

.data-box, 
.action-setup, 
.chip-setup, 
.num-setup, 
#total-bet-box, 
#bottom-status-text {
    pointer-events: auto; 
}

.data-box { 
    position: absolute; 
    background: rgba(255, 255, 255, 0.0); 
    border: 0px solid red; 
    color: #000; 
    text-align: center; 
    font-weight: 900; 
    z-index: 110; 
}

#score-val { 
    top: 11.5%; 
    left: 4%; 
    width: 15%; 
    height: 5%; 
    font-size: 1.8vw; 
}

#timer-val { 
    top: 32%; 
    left: -0.1%; 
    width: 23.6%; 
    height: 9.2%; 
    font-size: 1.8vw; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    background-size: 88% 100%; 
    background-repeat: no-repeat;
    background-position: center;
}

#winner-val { 
    top: 11.5%; 
    right: 5%; 
    width: 15%; 
    height: 5%; 
    font-size: 1.8vw; 
}

#history-val { 
    position: absolute;
    top: 34.5%; 
    right: 4%; 
    width: 18%; 
    height: 5%; 
    font-size: 1.8vw; 
    overflow: hidden; 
    white-space: nowrap; 
    display: flex; 
    align-items: center; 
    justify-content: center;
    letter-spacing: 1px;
    color: #000000;
    z-index: 110;
    font-weight: 900;
}

#total-bet-box { 
    position: absolute; 
    bottom: 0.5%; 
    left: 5%; 
    transform: translateX(-50%); 
    width: 6%; 
    height: 4%; 
    border: 0px solid #ffd700; 
    color: #000; 
    text-align: center; 
    font-size: 1vw; 
    font-weight: bold; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    z-index: 150; 
    border-radius: 5px; 
}

#bottom-status-text { 
    position: absolute; 
    bottom: 21.2%; 
    left: 92.5%; 
    transform: translateX(-50%); 
    width: 15%; 
    height: 5.5%; 
    color: #fff; 
    font-size: 1.1vw; 
    font-weight: bold; 
    z-index: 150; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    background-size: 100% 100%; 
    text-shadow: 2px 2px 4px #000; 
    cursor: pointer; 
    -webkit-tap-highlight-color: rgba(255, 255, 255, 0.0);
}

.action-setup { 
    position: absolute; 
    cursor: pointer; 
    z-index: 120; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    font-size: 1.1vw; 
    color: white; 
    font-weight: bold; 
    background-size: 100% 100%; 
    border: none; 
    -webkit-tap-highlight-color: rgba(255, 255, 255, 0.0);
}

#take-btn { 
    bottom: 21%; 
    left: 0%; 
    width: 15%; 
    height: 5.5%; 
}

#cancel-btn { 
    bottom: 20%; 
    left: 18%; 
    width: 13%; 
    height: 5.5%; 
    background-image: url('https://uploads.onecompiler.io/445tyzay6/44b9p9ez6/1000063327.png'); 
}

#cancel-all-bet-btn { 
    bottom: 20%; 
    right: 18%; 
    width: 13%; 
    height: 5.5%; 
    background-image: url('https://uploads.onecompiler.io/445tyzay6/44b9p9ez6/1000063327.png'); 
    font-size: 1vw; 
}

#exit-btn { 
    bottom: 0.6%; 
    right: 1%; 
    width: 6%; 
    height: 3.5%; 
    color: #fff; 
    background: rgba(0, 0, 0, 0.0); 
    border: 0px solid red; 
}

.chip-setup { 
    position: absolute; 
    width: 4.5%; 
    height: 4%; 
    cursor: pointer; 
    z-index: 130; 
    background: rgba(0, 0, 255, 0.0); 
    border: 0px solid blue; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    color: blue; 
    font-size: 0vw; 
    font-weight: bold; 
    -webkit-tap-highlight-color: rgba(0, 0, 255, 0.0);
    z-index: 1000 !important;
}

.num-setup { 
    position: absolute; 
    width: 6.5%; 
    height: 8.9%; 
    cursor: pointer; 
    z-index: 130;
    background-size: 100% 100%; 
    border: 0px solid yellow; 
    -webkit-tap-highlight-color: rgba(255, 255, 0, 0.0);
}

.bet-amt { 
    position: absolute; 
    width: 100%; 
    top: -40%; 
    text-align: center; 
    color: #000; 
    font-weight: bold; 
    font-size: 1.2vw; 
    text-shadow: 1px 1px 2px #000; 
}

#num-1 { 
    bottom: 5.3%; 
    left: 1.9%; 
}

#num-2 { 
    bottom: 5.3%; 
    left: 11.9%; 
}

#num-3 { 
    bottom: 5.3%; 
    left: 21.9%; 
}

#num-4 { 
    bottom: 5.3%; 
    left: 31.9%; 
}

#num-5 { 
    bottom: 5.3%; 
    left: 41.8%; 
}

#num-6 { 
    bottom: 5.3%; 
    left: 51.7%; 
}

#num-7 { 
    bottom: 5.3%; 
    left: 61.7%; 
}

#num-8 { 
    bottom: 5.3%; 
    left: 71.7%; 
}

#num-9 { 
    bottom: 5.3%; 
    left: 81.8%; 
}

#num-0 { 
    bottom: 5.3%; 
    left: 91.7%; 
}

.wheel-container { 
    position: absolute; 
    top: 41%; 
    left: 50%; 
    transform: translate(-50%, -55%); 
    width: 47%; 
    aspect-ratio: 1/1; 
    z-index: 50; 
    display: flex; 
    align-items: center; 
    pointer-events: none;
    justify-content: center; 
    /* व्हील को स्केल करने के लिए */
    transform: translate(-50%, -55%) scaleY(0.6);
}

/* व्हील के ऊपरी और निचले क्लिक एरिया */
.wheel-touch-area {
    position: absolute;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 160;
    background: transparent;
    border: none;
    outline: none;
    pointer-events: none;
    -webkit-tap-highlight-color: rgba(255, 255, 255, 0.0);
}

.pointer-container { 
    position: absolute; 
    top: -10px; 
    left: 50%; 
    transform: translateX(-50%); 
    width: 30px; 
    height: 30px; 
    z-index: 160; 
}

.ball-frame { 
    position: absolute; 
    width: 130px; 
    height: 130px; 
    border-radius: 50%; 
    top: 50%; 
    left: 50.3%; 
    transform: translate(-50%, -51.5%); 
    z-index: 0; 
    background-color: #000; 
}

.ning-ball { 
    width: 100%; 
    height: 105%; 
    background-size: contain; 
    background-repeat: no-repeat; 
    background-position: center; 
    background-image: url('Logo/Logo0.jpg'); 
}

#wheel-img { 
    width: 100%; 
    height: 100%; 
    transform: rotate(0deg); 
    transition: transform 7s cubic-bezier(0.1, 0, 0.0, 0); 
    pointer-events: none;
}

/* Pointer overlay styles */
.pointer-overlay { 
    position: absolute; 
    top: -10px; 
    left: 50%; 
    transform: translateX(-50%); 
    width: 30px; 
    height: 30px; 
    background-image: var(--arrow-img); 
    background-size: contain; 
    background-repeat: no-repeat;
    z-index: 200; 
}

.pointer-overlay.jiggle { 
    animation: blink-pointer 0.4s steps(1) infinite; 
}

@keyframes blink-pointer { 
    0%, 100% { 
        opacity: 1; 
    } 
    50% { 
        opacity: 0; 
    } 
}

@keyframes timer-bg-anim { 
    0%, 100% { 
        background-image: url('https://uploads.onecompiler.io/445tyzay6/44cdp4uqr/1000082340.png'); 
    } 
    50% { 
        background-image: none; 
    } 
}

.timer-bg-blink { 
    animation: timer-bg-anim 0.5s step-end infinite; 
}

@keyframes image-only-blink { 
    0%, 100% { 
        background-image: var(--bg-img); 
        opacity: 1; 
    } 
    50% { 
        background-image: none; 
    } 
}

.blink-bg { 
    animation: image-only-blink 0.4s step-end infinite; 
}

@keyframes bet-blink-anim { 
    0%, 100% { 
        background-image: url('https://uploads.onecompiler.io/445tyzay6/44baxzbt9/1000063333.jpg'); 
    } 
    50% { 
        background-image: none; 
    } 
}

.bet-ok-blink { 
    animation: bet-blink-anim 0.4s step-end infinite; 
}

@keyframes take-blink-anim { 
    0%, 100% { 
        background-image: url('https://uploads.onecompiler.io/445tyzay6/44bb8xqdr/1000063336.jpg'); 
    } 
    50% { 
        background-image: none; 
    } 
}

.take-active-blink { 
    animation: take-blink-anim 0.4s step-end infinite; 
}

@keyframes overlay-blink-anim { 
    0%, 100% { 
        background-image: url('https://uploads.onecompiler.io/445tyzay6/44bb8xqdr/1000063325.png'); 
    } 
    50% { 
        background-image: none; 
    } 
}

.cancel-overlay-blink::after { 
    content: ''; 
    position: absolute; 
    top:0; 
    left:0; 
    width:100%; 
    height:100%; 
    background-size:100% 100%; 
    pointer-events:none; 
    z-index:121; 
    animation: overlay-blink-anim 0.4s step-end infinite; 
}

.animate-now {
    animation: rotateBall 3s steps(1) infinite;
}

@keyframes rotateBall {
    0%   { background-image: url('Logo/Logo0.jpg'); }
    5%   { background-image: url('Logo/Logo1.jpg'); }
    10%  { background-image: url('Logo/Logo2.jpg'); }
    15%  { background-image: url('Logo/Logo3.jpg'); }
    20%  { background-image: url('Logo/Logo4.jpg'); }
    25%  { background-image: url('Logo/Logo5.jpg'); }
    30%  { background-image: url('Logo/Logo6.jpg'); }
    35%  { background-image: url('Logo/Logo7.jpg'); }
    40%  { background-image: url('Logo/Logo8.jpg'); }
    45%  { background-image: url('Logo/Logo9.jpg'); }
    50%  { background-image: url('Logo/Logo10.jpg'); }
    55%  { background-image: url('Logo/Logo11.jpg'); }
    60%  { background-image: url('Logo/Logo12.jpg'); }
    65%  { background-image: url('Logo/Logo13.jpg'); }
    70%  { background-image: url('Logo/Logo14.jpg'); }
    75%  { background-image: url('Logo/Logo15.jpg'); }
    80%  { background-image: url('Logo/Logo16.jpg'); }
    85%  { background-image: url('Logo/Logo17.jpg'); }
    90%  { background-image: url('Logo/Logo18.jpg'); }
    95%  { background-image: url('Logo/Logo19.jpg'); }
    100% { background-image: url('Logo/Logo0.jpg'); }
}

#pleaseWaitOverlay {
    display: none;
    position: absolute;
    bottom: 0%;
    left: 25%;
    width: 50%;
    height: 5%;
    background: rgba(0, 0, 0, 0.0);
    z-index: 500;
    color: var(--gold-orange);
    font-size: 1.5vw;
    font-weight: bold;
    justify-content: center;
    align-items: center;
    text-shadow: 2px #000;
    pointer-events: auto; 
    border-radius: 0px;
}

/* बटन पर क्लिक होने पर हाईलाइट दिखाने के लिए */
.click-effect:active {
    transform: scale(0.95);
    opacity: 0.8;
    transition: transform 0.1s, opacity 0.1s;
}

/* क्लिक रोकने के लिए */
.no-click {
    pointer-events: none;
}

/* डबल टैप जूम रोकने के लिए */
* {
    -ms-content-zooming: none;
    -ms-touch-action: manipulation;
}