    document.addEventListener('DOMContentLoaded', function() {

        const statusMsg = document.getElementById("statusMsg");
        if(statusMsg) {
            statusMsg.classList.add("header-blink");
            setTimeout(() => {
                statusMsg.classList.remove("header-blink");
            }, 5000);
        }

        document.addEventListener('selectstart', function(e) { e.preventDefault(); return false; });
        document.addEventListener('contextmenu', function(e) { e.preventDefault(); return false; });
        document.addEventListener('dragstart', function(e) { e.preventDefault(); return false; });
        document.addEventListener('copy', function(e) { e.preventDefault(); return false; });
        document.addEventListener('cut', function(e) { e.preventDefault(); return false; });
        document.addEventListener('paste', function(e) { e.preventDefault(); return false; });
        document.addEventListener('dblclick', function(e) { e.preventDefault(); return false; });

        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && (e.key === 'c' || e.key === 'C' || e.key === 'x' || e.key === 'X' || e.key === 'v' || e.key === 'V')) {
                e.preventDefault();
                return false;
            }
            if (e.key === 'F12') { e.preventDefault(); return false; }
            if (e.ctrlKey && e.key === 'u') { e.preventDefault(); return false; }
        });

        document.addEventListener('touchstart', function(e) {
            var target = e.target;
            if (target.classList.contains('btn-enter-visual') ||
                target.classList.contains('btn-close-visual') ||
                target.classList.contains('fun-target-box') ||
                target.classList.contains('child-reg-container') ||
                target.classList.contains('point-transfer-image') ||
                target.classList.contains('wheel-touch-area') ||
                target.classList.contains('btn-orange') ||
                target.classList.contains('refresh-action') ||
                target.classList.contains('logout-action') ||
                target.classList.contains('m-btn') ||
                target.classList.contains('action-setup') ||
                target.classList.contains('chip-setup') ||
                target.classList.contains('num-setup') ||
                target.id === 'bottom-status-text') {

                target.classList.add('click-effect');
                setTimeout(function() {
                    target.classList.remove('click-effect');
                }, 150);
            }
        }, {passive: true});
    });

    function handleWheelClick(event) {
        if (!isGameActive) return;
        playAudio(clickAudio);

        const wheelContainer = document.querySelector('.wheel-container');
        const rect = wheelContainer.getBoundingClientRect();
        const clickY = event.clientY - rect.top;
        const wheelHeight = rect.height;

        if (clickY < wheelHeight / 2) lightSpin('up');
        else lightSpin('down');
    }

    function lightSpin(direction) {
        const wheel = document.getElementById('wheel-img');
        const currentRotationVal = getCurrentRotation(wheel);

        let spinAmount = 0;

        if (direction === 'up') spinAmount = 90 + Math.random() * 45;
        else spinAmount = -90 - Math.random() * 45;

        const newRotation = currentRotationVal + spinAmount;

        wheel.style.transition = 'transform 1.5s cubic-bezier(0.2, 0.1, 0.2, 1)';
        wheel.style.transform = `rotate(${newRotation}deg)`;

        playAudio(spinAudio);

        setTimeout(() => {
            wheel.style.transition = 'transform 0.5s ease-out';
            wheel.style.transform = `rotate(${currentRotationVal}deg)`;
        }, 1500);
    }

    function getCurrentRotation(element) {
        const style = window.getComputedStyle(element);
        const matrix = style.transform || style.webkitTransform || style.mozTransform;

        if (matrix !== 'none') {
            const values = matrix.split('(')[1].split(')')[0].split(',');
            const a = values[0];
            const b = values[1];
            const angle = Math.round(Math.atan2(b, a) * (180 / Math.PI));
            return angle < 0 ? angle + 360 : angle;
        }
        return 0;
    }

    let billingTimerInterval = null;
    let billingTimeLeft = 3;
    let isBillingActive = false;

    function startBilling() {
        if (isBillingActive) return;

        isBillingActive = true;
        billingTimeLeft = 3;

        document.querySelector('.point-transfer-image').style.display = 'none';
        document.getElementById('billingTimer').style.display = 'block';
        document.getElementById('billingTimer').textContent = 'BILLING... 3';

        billingTimerInterval = setInterval(function() {
            billingTimeLeft--;
            document.getElementById('billingTimer').textContent = 'BILLING... ' + billingTimeLeft;

            if (billingTimeLeft <= 0) stopBilling();
        }, 1000);

        if (isGameActive) playAudio(buttonAudio);
    }

    function stopBilling() {
        clearInterval(billingTimerInterval);
        billingTimerInterval = null;
        isBillingActive = false;

        document.getElementById('billingTimer').style.display = 'none';
        document.querySelector('.point-transfer-image').style.display = 'block';

        if (isGameActive) playAudio(winAudio);
    }

    window.addEventListener('beforeunload', function() {
        if (billingTimerInterval) clearInterval(billingTimerInterval);
        if (globalGameTimer) clearInterval(globalGameTimer);
    });

    function loginWithEffect() {
        const enterBtn = document.getElementById('enterBtn');
        enterBtn.classList.add('enter-clicked');

        setTimeout(() => {
            enterBtn.classList.remove('enter-clicked');
            login();
        }, 1000);
    }

    function closeLoginAndExit() {
        const closeBtn = document.getElementById('closeBtn');

        closeBtn.classList.add('clicked');

        document.getElementById('uid').value = '';
        document.getElementById('pass').value = '';
        document.getElementById('statusMsg').textContent = "Please Now Login";
        document.getElementById('statusMsg').style.color = "#ff8c00";

        setTimeout(() => {
            closeBtn.classList.remove('clicked');

            window.close();

            if (window.history.length > 1) window.history.back();
            else window.location.href = "about:blank";

        }, 1000);
    }

    const timerAudio = document.getElementById('timerAudio');
    const spinAudio = document.getElementById('spinAudio');
    const buttonAudio = document.getElementById('buttonAudio');
    const betAudio = document.getElementById('betAudio');
    const winAudio = document.getElementById('winAudio');
    const clickAudio = document.getElementById('clickAudio');

    let isGameActive = false;
    let isPageVisible = true;
    let timerAudioInterval = null;
    let globalGameTimer = null;

    const pointerOverlay = document.getElementById('pointerOverlay');

    function playAudio(audioElement) {
        if (!isGameActive || !isPageVisible) return;
        audioElement.currentTime = 0;
        audioElement.play().catch(e => console.log("Audio play failed:", e));
    }

    function stopAllAudio() {
        timerAudio.pause(); timerAudio.currentTime = 0;
        spinAudio.pause(); spinAudio.currentTime = 0;
        buttonAudio.pause(); buttonAudio.currentTime = 0;
        betAudio.pause(); betAudio.currentTime = 0;
        winAudio.pause(); winAudio.currentTime = 0;
        clickAudio.pause(); clickAudio.currentTime = 0;

        if (timerAudioInterval) { clearInterval(timerAudioInterval); timerAudioInterval = null; }
        if (billingTimerInterval) { clearInterval(billingTimerInterval); billingTimerInterval = null; isBillingActive = false; }
    }

    document.addEventListener('visibilitychange', function() {
        if (document.hidden) { isPageVisible = false; stopAllAudio(); }
        else { isPageVisible = true; }
    });

    const firebaseConfig =
    {
        apiKey: "AIzaSyConir_wAwdSI7BsQj-vJsL3496CRb64To",
        databaseURL: "https://funtarget-c2bf0-default-rtdb.firebaseio.com",
        projectId: "funtarget-c2bf0"
    };

    firebase.initializeApp(firebaseConfig);
    const db = firebase.database();

    let myId = "";
    let balance = 0;
    let selectedChip = 10;
    let currentRotation = 0;
    let bets = {0:0,1:0,2:0,3:0,4:0,5:0,6:0,7:0,8:0,9:0};
    let historyArr = [];
    let pendingWin = 0;
    let currentWinnerNum = -1;
    let currentStatus = "BETTING";
    let currentTime = 60;
    let resultShownForRound = -1;

    let ballImages = [];
    let isAutoBallSystemReady = false;

    let patternStage = "WIN";
    let lossCounter = 0;
    let currentLossSequence = 0;
    const lossSequence = [3, 5, 6, 4, 8, 3, 9, 10, 1, 15, 20, 5, 2, 11, 5, 21, 10, 22, 50, 5, 10, 20, 5, 10];
    let lossSequenceIndex = 0;

    const numberDegrees = { 0:0, 1:36, 2:72, 3:108, 4:144, 5:180, 6:216, 7:252, 8:288, 9:324 };
    const numImgs = {
        0: 'BetGlow/BetGlow0.jpg',
        1: 'BetGlow/BetGlow1.jpg',
        2: 'BetGlow/BetGlow2.jpg',
        3: 'BetGlow/BetGlow3.jpg',
        4: 'BetGlow/BetGlow4.jpg',
        5: 'BetGlow/BetGlow5.jpg',
        6: 'BetGlow/BetGlow6.jpg',
        7: 'BetGlow/BetGlow7.jpg',
        8: 'BetGlow/BetGlow8.jpg',
        9: 'BetGlow/BetGlow9.jpg'
    };

    const sUI = document.getElementById('score-val');
    const tUI = document.getElementById('timer-val');
    const hUI = document.getElementById('history-val');
    const winUI = document.getElementById('winner-val');
    const takeBtn = document.getElementById('take-btn');
    const statusText = document.getElementById('bottom-status-text');
    const totalBetDisplay = document.getElementById('total-bet-box');
    const w = document.getElementById('wheel-img');
    const ball = document.getElementById('ning-ball');
    const cancelBtn = document.getElementById('cancel-btn');
    const cancelAllBtn = document.getElementById('cancel-all-bet-btn');
    const waitOverlay = document.getElementById('pleaseWaitOverlay');
    const sessionId = 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);

    function updateTotalBet() {
        const totalBet = Object.values(bets).reduce((a, b) => a + b, 0);
        if (totalBetDisplay) totalBetDisplay.innerText = totalBet;
    }

    // ✅ CHIP SELECT FIX
    window.selChip = function(v) {
        selectedChip = v;
        statusText.innerText = "Chip Selected: " + v;

        blinkStatusText();
        if(isGameActive) playAudio(clickAudio);
    };

    let pointerBlinkInterval = null;
    let cancelBlinkInterval = null;
    let statusBlinkCount = 0;
    let statusBlinkInterval = null;

    function initializeAutoBallSystem() {
        ballImages = [
            {id: 'logo_5', url: 'Logo/Logo5.jpg'},
            {id: 'logo_10', url: 'Logo/Logo10.jpg'},
            {id: 'logo_15', url: 'Logo/Logo15.jpg'}
        ];

        db.ref("game/currentBall").on("value", (snap) => {
            if (snap.exists()) {
                const currentBallId = snap.val();
                const foundBall = ballImages.find(b => b.id === currentBallId);
                if (foundBall) ball.style.backgroundImage = `url('${foundBall.url}')`;
            }
        });

        isAutoBallSystemReady = true;
    }

    function startPointerBlink() {
        if (pointerOverlay) pointerOverlay.classList.add('jiggle');
    }

    function stopPointerBlink() {
        if (pointerOverlay) pointerOverlay.classList.remove('jiggle');
    }

    function startResultPointerBlink() {
        stopPointerBlink();
        pointerOverlay.classList.add('jiggle');

        if (pointerBlinkInterval) clearInterval(pointerBlinkInterval);
        pointerBlinkInterval = setTimeout(() => {
            pointerOverlay.classList.remove('jiggle');
            pointerBlinkInterval = null;
        }, 10000);
    }

    function updateCancelButtonBlink() {
        const totalBet = Object.values(bets).reduce((a, b) => a + b, 0);

        if (currentTime <= 45 && totalBet > 15 && currentStatus === "BETTING") {
            if (!cancelBtn.classList.contains('cancel-overlay-blink')) {
                cancelBtn.classList.add('cancel-overlay-blink');
                cancelAllBtn.classList.add('cancel-overlay-blink');
            }

            if (!cancelBlinkInterval) {
                cancelBlinkInterval = setInterval(() => {
                    if (currentTime <= 45 && totalBet > 15 && currentStatus === "BETTING") {
                        cancelBtn.classList.toggle('cancel-overlay-blink');
                        cancelAllBtn.classList.toggle('cancel-overlay-blink');
                    } else {
                        stopCancelBlink();
                    }
                }, 4500);
            }
        } else {
            stopCancelBlink();
        }
    }

    function stopCancelBlink() {
        cancelBtn.classList.remove('cancel-overlay-blink');
        cancelAllBtn.classList.remove('cancel-overlay-blink');

        if (cancelBlinkInterval) {
            clearInterval(cancelBlinkInterval);
            cancelBlinkInterval = null;
        }
    }

    function blinkStatusText() {
        if (statusBlinkInterval) clearInterval(statusBlinkInterval);

        statusBlinkCount = 0;
        statusBlinkInterval = setInterval(() => {
            statusText.classList.toggle('bet-ok-blink');
            statusBlinkCount++;

            if (statusBlinkCount >= 10) {
                clearInterval(statusBlinkInterval);
                statusBlinkInterval = null;
                statusText.classList.remove('bet-ok-blink');
            }
        }, 200);
    }

    function getWinningNumberByPattern() {
        let numbersWithBets = Object.entries(bets).filter(([n, b]) => b > 0).map(([n, b]) => parseInt(n));
        let numbersWithoutBets = Object.entries(bets).filter(([n, b]) => b === 0).map(([n, b]) => parseInt(n));

        if (patternStage === "WIN") {
            if (numbersWithBets.length > 0) {
                let minBet = Math.min(...numbersWithBets.map(n => bets[n]));
                let choices = numbersWithBets.filter(n => bets[n] === minBet);
                return choices[Math.floor(Math.random() * choices.length)];
            }
            return Math.floor(Math.random() * 10);
        } else {
            if (numbersWithoutBets.length > 0) return numbersWithoutBets[Math.floor(Math.random() * numbersWithoutBets.length)];
            return Math.floor(Math.random() * 10);
        }
    }

    function updatePattern(winNum) {
        if (patternStage === "WIN") {
            patternStage = "LOSS";
            currentLossSequence = lossSequence[lossSequenceIndex];
            lossSequenceIndex = (lossSequenceIndex + 1) % lossSequence.length;
            lossCounter = 0;
        } else {
            lossCounter++;
            if (lossCounter >= currentLossSequence) patternStage = "WIN";
        }
    }

    function syncHistoryFromFirebase() {
        db.ref("game/history").on("value", (snapshot) => {
            if (snapshot.exists()) {
                const hData = snapshot.val();
                if (Array.isArray(hData)) {
                    historyArr = hData;
                    hUI.innerText = historyArr.join(' ');
                } else {
                    db.ref("game/history").transaction((h) => {
                        if (!Array.isArray(h)) return [];
                        return h;
                    });
                }
            } else {
                db.ref("game/history").transaction((h) => {
                    if (h === null) return [];
                    return h;
                });
            }
        });
    }

    function updateHistoryInFirebase(winningNumber) {
        db.ref("game/history").transaction((currentH) => {
            if (!Array.isArray(currentH)) currentH = [];
            currentH.push(winningNumber);
            if (currentH.length > 10) currentH.shift();
            return currentH;
        });
    }

    async function login() {
        const u = document.getElementById('uid').value.trim();
        const p = document.getElementById('pass').value.trim();

        if(!u || !p) return;

        if (!/^\d{8}$/.test(u)) {
            alert("कृपया ID के केवल आखिरी 8 अंक ही डालें!");
            return;
        }

        document.getElementById('statusMsg').textContent = "VERIFY...";
        document.getElementById('statusMsg').style.color = "#39ff14";

        let fullUserId = "GK5" + u;

        const snap = await db.ref("users/" + fullUserId).once("value");

        if (snap.exists()) {
            const val = snap.val();

            if (val.password === p && val.status === "active") {
                await db.ref("users/" + fullUserId).update({
                    isLoggedIn: true,
                    sessionId: sessionId
                });

                myId = fullUserId;
                sessionStorage.setItem('gk_session', JSON.stringify({
                    uid: fullUserId,
                    sessionId: sessionId
                }));

                setupLoginMonitor(fullUserId);
                activateHome();
            } else {
                alert("Wrong Password या ID inactive है!");
                document.getElementById('statusMsg').textContent = "Please Now Login";
                document.getElementById('statusMsg').style.color = "#ff8c00";
            }
        } else {
            alert("User ID नहीं मिली!");
            document.getElementById('statusMsg').textContent = "Please Now Login";
            document.getElementById('statusMsg').style.color = "#ff8c00";
        }
    }

    function setupLoginMonitor(uid) {
        db.ref("users/" + uid).on("value", (snap) => {
            if (snap.exists() && (snap.val().sessionId !== sessionId || snap.val().forceLogout)) forceLogout();
        });
    }

    function forceLogout() {
        sessionStorage.removeItem('gk_session');
        location.reload();
    }

    function activateHome() {
        isGameActive = false;
        stopAllAudio();

        document.getElementById('loginSection').style.display = 'none';
        document.getElementById('homeSection').style.display = 'block';
        document.getElementById('gameSection').style.display = 'none';

        document.getElementById('idVal').textContent = myId;

        syncFromFirebase();

        if (billingTimerInterval) { clearInterval(billingTimerInterval); billingTimerInterval = null; }
        isBillingActive = false;
        document.getElementById('billingTimer').style.display = 'none';
        document.querySelector('.point-transfer-image').style.display = 'block';

        initGameIfMissing();
    }

    function launchGame() {
    isGameActive = true;

    // 🔥 UNLOCK AUDIO (WebView Fix)
    [timerAudio, spinAudio, buttonAudio, betAudio, winAudio, clickAudio].forEach(a => {
        if (!a) return;
        a.play().then(() => {
            a.pause();
            a.currentTime = 0;
        }).catch(()=>{});
    });

    document.getElementById('homeSection').style.display = 'none';
    document.getElementById('gameSection').style.display = 'block';
    initializeAutoBallSystem();

    if (billingTimerInterval) {
        clearInterval(billingTimerInterval);
        billingTimerInterval = null;
    }
    isBillingActive = false;
}

    function backToHome() {
        isGameActive = false;
        stopAllAudio();
        document.getElementById('gameSection').style.display = 'none';
        document.getElementById('homeSection').style.display = 'block';

        stopPointerBlink();
        stopCancelBlink();
        if (pointerBlinkInterval) clearTimeout(pointerBlinkInterval);
        if (statusBlinkInterval) clearInterval(statusBlinkInterval);
    }

    async function logout() {
        if (globalGameTimer) {
            clearInterval(globalGameTimer);
            globalGameTimer = null;
        }

        if (myId) await db.ref("users/" + myId).update({ isLoggedIn: false, sessionId: null });
        sessionStorage.removeItem('gk_session');
        location.reload();
    }

    function syncFromFirebase() {
        db.ref("users/" + myId).on("value", (snap) => {
            if(snap.exists()) {
                balance = parseFloat(snap.val().balance || 0);
                pendingWin = parseFloat(snap.val().pendingWin || 0);

                document.getElementById('ptsVal').textContent = balance.toFixed(2);
                sUI.innerText = balance.toFixed(2);

                if(pendingWin > 0) {
                    takeBtn.classList.add('take-active-blink');
                    takeBtn.innerText = `TAKE (${pendingWin})`;
                } else {
                    takeBtn.classList.remove('take-active-blink');
                    takeBtn.innerText = "TAKE";
                }
            }
        });
    }

    function updateFirebaseBalance(nb, np) {
        db.ref("users/" + myId).update({ balance: nb, pendingWin: np });
    }

    let localTimerInterval = null;

    async function initGameIfMissing() {
        const snap = await db.ref("game").once("value");

        if (!snap.exists()) {
            await db.ref("game").update({
                status: "BETTING",
                round: 1,
                lastWinner: 0,
                endTime: Date.now() + 60000,
                currentBall: "logo_5",
                ballImages: ["logo_5", "logo_10", "logo_15"]
            });
        }
    }

    function autoUpdateGameState() {
        db.ref("game").transaction((g) => {
            if (!g) return g;

            const now = Date.now();

            if (!g.endTime || g.endTime === 0) {
                g.endTime = now + 60000;
                return g;
            }

            if (now < g.endTime) return g;

            if (g.status === "BETTING") {
                g.status = "WAITING";
                g.endTime = now + 1000;

                g.lastWinner = getWinningNumberByPattern();

                if (g.lastWinner <= 6) g.currentBall = "logo_5";
                else if (g.lastWinner <= 12) g.currentBall = "logo_10";
                else g.currentBall = "logo_15";
            }
            else if (g.status === "WAITING") {
                g.status = "RESULT_HOLD";
                g.endTime = now + 1000;
            }
            else if (g.status === "RESULT_HOLD") {
                g.status = "BETTING";
                g.round = (g.round || 0) + 1;
                g.endTime = now + 60000;
            }

            return g;
        });
    }

    if (globalGameTimer) clearInterval(globalGameTimer);
    globalGameTimer = setInterval(() => {
        autoUpdateGameState();
    }, 1000);

    let latestGameData = null;

    db.ref("game").on("value", (snap) => {
        const d = snap.val();
        if(!d) return;

        latestGameData = d;

        currentStatus = d.status || "BETTING";
        currentWinnerNum = d.lastWinner || 0;

        if (localTimerInterval) clearInterval(localTimerInterval);

        localTimerInterval = setInterval(() => {

            if (!latestGameData || !latestGameData.endTime) return;

            let left = Math.floor((latestGameData.endTime - Date.now()) / 1000);
            if (left < 0) left = 0;

            currentTime = left;

           
            // ✅ 7-Segment Format (60, 59... 09, 08)
            tUI.innerText = currentTime < 10 ? '0'+currentTime : currentTime;

            if (currentTime <= 15 && currentTime > 10 && currentStatus === "BETTING") {
                tUI.classList.add('timer-bg-blink');
            } else {
                tUI.classList.remove('timer-bg-blink');
            }

            if (isGameActive && currentTime > 10 && currentStatus === "BETTING") playAudio(timerAudio);

            if (currentStatus !== "BETTING" || currentTime <= 15) waitOverlay.style.display = 'flex';
            else waitOverlay.style.display = 'none';

            if (currentStatus === "BETTING" && currentTime === 8 && resultShownForRound !== latestGameData.round) {
                startSpinProcess(latestGameData.lastWinner, latestGameData.round);
            }

            if (currentStatus === "BETTING" && currentTime <= 6) startPointerBlink();
            else stopPointerBlink();

            if (currentStatus === "RESULT_HOLD") startResultPointerBlink();

            updateCancelButtonBlink();

        }, 1000);
    });

    function startSpinProcess(wn, rn) {
        if (isGameActive) playAudio(spinAudio);

        resultShownForRound = rn;
        ball.classList.add('animate-now');

        let target = 360 - numberDegrees[wn];
        currentRotation += 3600 + (target - (currentRotation % 360));

        w.ontransitionend = null;

        w.style.transform = `rotate(${currentRotation}deg)`;

        w.ontransitionend = () => {

            w.ontransitionend = null;

            ball.classList.remove('animate-now');
            currentWinnerNum = wn;

            const wb = document.getElementById(`num-${wn}`);
            wb.style.setProperty('--bg-img', `url(${numImgs[wn]})`);
            wb.classList.add('blink-bg');

            updateHistoryInFirebase(wn);

            winUI.innerText = "₹" + ((bets[wn] || 0) * 9);

            if ((bets[wn] || 0) > 0) {
                pendingWin += (bets[wn] || 0) * 9;
                updateFirebaseBalance(balance, pendingWin);

                if (isGameActive) playAudio(winAudio);
            }

            updatePattern(wn);
            resetTable();
        };
    }

    function resetTable() {
        for(let i=0; i<=9; i++) {
            document.getElementById(`b-${i}`).innerText = '0';
            document.getElementById(`num-${i}`).style.backgroundImage = 'none';
            document.getElementById(`num-${i}`).classList.remove('blink-bg');
        }

        bets = {0:0,1:0,2:0,3:0,4:0,5:0,6:0,7:0,8:0,9:0};

        statusText.innerText = "Prev bet";
        statusText.classList.remove('bet-ok-blink');

        updateTotalBet();
        stopCancelBlink();
    }

    // ✅ PLACE BET
    window.place = function(n) {
        if(currentStatus !== "BETTING" || pendingWin > 0 || currentTime <= 15) return;

        if ((bets[n] + selectedChip) > 5000) {
            statusText.innerText = "Max Bet Limit 5000";
            blinkStatusText();
            return;
        }

        if(balance >= selectedChip) {
            balance -= selectedChip;
            bets[n] += selectedChip;

            document.getElementById(`b-${n}`).innerText = bets[n];
            document.getElementById(`num-${n}`).style.backgroundImage = `url(${numImgs[n]})`;

            statusText.innerText = "Bet ok";
            blinkStatusText();

            updateTotalBet();
            updateFirebaseBalance(balance, pendingWin);

            if(isGameActive) playAudio(betAudio);

            updateCancelButtonBlink();
        }
    };


// ✅ HOLD BET SYSTEM (TRACTOR BET)
let holdInterval = null;
let holdTimeout = null;
let isHolding = false;

function startHoldBet(n) {
    if (isHolding) return;
    isHolding = true;

    // पहले तुरंत 1 बार place करो
    place(n);

    // 400ms बाद auto repeat start
    holdTimeout = setTimeout(() => {
        holdInterval = setInterval(() => {
            place(n);
        }, 120);
    }, 400);
}

function stopHoldBet() {
    isHolding = false;

    if (holdTimeout) {
        clearTimeout(holdTimeout);
        holdTimeout = null;
    }

    if (holdInterval) {
        clearInterval(holdInterval);
        holdInterval = null;
    }
}

    window.doTake = function() {
        if(isGameActive) playAudio(buttonAudio);

        if(pendingWin > 0) {
            balance += pendingWin;
            pendingWin = 0;
            updateFirebaseBalance(balance, 0);
            winUI.innerText = "0";
        }
    };

    // ✅ FIXED CANCEL
    window.doCancel = function() {
        if(currentStatus !== "BETTING" || currentTime <= 15) return;

        for(let i=9; i>=0; i--) {
            if(bets[i] > 0) {

                let cancelAmt = Math.min(selectedChip, bets[i]);

                bets[i] -= cancelAmt;
                balance += cancelAmt;

                document.getElementById(`b-${i}`).innerText = bets[i];

                if(bets[i] === 0) {
                    document.getElementById(`num-${i}`).style.backgroundImage = "none";
                    document.getElementById(`num-${i}`).classList.remove("blink-bg");
                }

                break;
            }
        }

        updateTotalBet();
        updateFirebaseBalance(balance, pendingWin);

        if(isGameActive) playAudio(buttonAudio);

        updateCancelButtonBlink();
    };

    // ✅ FIXED CANCEL ALL
    window.doCancelAll = function() {
        if(currentStatus !== "BETTING" || currentTime <= 15) return;

        let totalRefund = Object.values(bets).reduce((a,b)=>a+b,0);
        if(totalRefund <= 0) return;

        balance += totalRefund;

        resetTable();

        updateTotalBet();
        updateFirebaseBalance(balance, pendingWin);

        if(isGameActive) playAudio(buttonAudio);

        updateCancelButtonBlink();
    };

    function openTransferModal() {
        document.getElementById('transferModal').style.display = 'flex';
    }

    function closeTransferModal() {
        document.getElementById('transferModal').style.display = 'none';
    }

    async function executeRealTransfer() {
        const tid = document.getElementById('targetId').value.trim();
        const amt = parseFloat(document.getElementById('transferAmt').value);
        const pin = document.getElementById('transferPin').value;
        const res = document.getElementById('modalResMsg');

        const sSnap = await db.ref("users/" + myId).once("value");

        if (sSnap.val().pin.toString() === pin && balance >= amt) {
            const tSnap = await db.ref("users/" + tid).once("value");

            if (tSnap.exists()) {
                await db.ref("users/" + myId).update({ balance: balance - amt });
                await db.ref("users/" + tid).update({ balance: (tSnap.val().balance || 0) + amt });

                res.textContent = "Success!";
                setTimeout(closeTransferModal, 1000);

            } else res.textContent = "ID Not Found!";
        } else res.textContent = "Wrong PIN/Balance!";
    }

    window.onload = () => {
        syncHistoryFromFirebase();

        const s = sessionStorage.getItem('gk_session');
        if (s) {
            const sd = JSON.parse(s);
            myId = sd.uid;

            db.ref("users/" + myId).once("value").then(snap => {
                if (snap.exists() && snap.val().sessionId === sd.sessionId) {
                    setupLoginMonitor(myId);
                    activateHome();
                }
            });
        }
    };