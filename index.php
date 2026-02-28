<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GK Gaming & Fun Target - Integrated System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body oncontextmenu="return false;">
    
    <!-- Audio Elements -->
    <audio id="timerAudio" src="audio/reset1_sound.mp3"></audio>
    <audio id="spinAudio" src="audio/reset2_sound.mp3"></audio>
    <audio id="buttonAudio" src="audio/reset3_sound.mp3"></audio>
    <audio id="betAudio" src="audio/reset4_sound.mp3"></audio>
    <audio id="winAudio" src="audio/reset5_sound.mp3"></audio>
    <audio id="clickAudio" src="audio/reset6_sound.mp3"></audio>

    <!-- Login Section -->
    <div id="loginSection">
        <div class="response-header">
            <span id="statusMsg">Please Now Login</span>
        </div>
        <div class="input-area">
            <input type="tel" id="uid" class="gk-input" placeholder="" inputmode="numeric" autocomplete="one-time-code">
            <input type="password" id="pass" class="gk-input" placeholder="">
        </div>
        <button id="enterBtn" class="btn-enter-visual" onclick="loginWithEffect()">ENTER</button>
        <button id="closeBtn" class="btn-close-visual" onclick="closeLoginAndExit()"></button>
    </div>

    <!-- Home Section -->
    <div id="homeSection">
        <div class="points-selector-container">
            <div class="option">
                <input type="radio" id="gk" name="game_points" checked>
                <label for="gk">
                    <span class="circle"></span>
                    GK Points
                </label>
            </div>
            <div class="option">
                <input type="radio" id="multi" name="game_points">
                <label for="multi">
                    <span class="circle"></span>
                    Multiplayer Points
                </label>
            </div>
        </div>

        <div class="top-nav">
            <div class="id-label"> <span id="idVal" class="dynamic-val">---</span></div>
            <div class="points-label"> <span id="ptsVal" class="dynamic-val">0</span></div>
        </div>
        <div class="game-header">GAME</div>
        <div class="fun-target-box" onclick="launchGame()">FUN TARGET</div>

        <div class="child-reg-container" onclick="openTransferModal()">
            <div class="child-reg-text">POINT<br>TRANSFER</div>
        </div>

        <button class="point-transfer-image" onclick="startBilling()">
            <img src="https://uploads.onecompiler.io/445tyzay6/44c7sf4c6/1000081992.png" alt="Point Transfer">
        </button>

        <div class="billing-timer" id="billingTimer"></div>

        <div class="panel-action-bar">
            <div class="label-green">Receivables</div>
            <div class="btn-orange">RECEIVE</div>
            <div class="btn-orange">REJECT</div>
            <div class="label-green">Transferables</div>
            <div class="btn-orange">REJECT</div>
        </div>
        <div class="footer-links">
            <div class="refresh-action" onclick="location.reload()">REFRESH</div>
            <div class="logout-action" onclick="logout()">LOGOUT</div>
        </div>
    </div>

    <!-- Game Section -->
    <div id="gameSection">
        <div id="pleaseWaitOverlay">PLEASE WAIT...</div>

        <div class="deep-background"></div>
        
        <div class="wheel-container">
            <button class="wheel-touch-area" onclick="handleWheelClick(event)"></button>
            
            <div class="pointer-container">
                <img class="pointer-base" src="BetGlow/ArrowGlow.png" style="width:100%">
            </div>
            <div class="pointer-overlay" id="pointerOverlay"></div>
            <div class="ball-frame">
                <div id="ning-ball" class="ning-ball"></div>
            </div>
            <img id="wheel-img" src="BetGlow/Wheel5.png">
        </div>

        <div class="game-wrapper">
            <div id="score-val" class="data-box">0</div>
            <div id="timer-val" class="data-box">--</div>
            <div id="winner-val" class="data-box">?</div>
            
            <div id="history-val"></div>
            
            <div id="total-bet-box">0</div>
            <div id="bottom-status-text" onclick="toggleBetOkBlink()">Prev bet</div>

            <div id="take-btn" class="action-setup" onclick="doTake()">TAKE</div>
            <div id="cancel-btn" class="action-setup" onclick="doCancel()">CANCEL</div>

            <div id="cancel-all-bet-btn" class="action-setup" onclick="doCancelAll()">CANCEL ALL</div>
            <div id="exit-btn" class="action-setup" onclick="backToHome()">EXIT</div>

            <!-- Chip Setup -->
            <div id="chip-1" class="chip-setup" style="top:48%; left:0.5%;" onclick="selChip(1)">1</div>
            <div id="chip-5" class="chip-setup" style="top:48%; left:6%;" onclick="selChip(5)">5</div>
            <div id="chip-10" class="chip-setup" style="top:48%; left:11.5%;" onclick="selChip(10)">10</div>
            <div id="chip-50" class="chip-setup" style="top:48%; left:17.4%;" onclick="selChip(50)">50</div>
            <div id="chip-100" class="chip-setup" style="top:48%; right:17%;" onclick="selChip(100)">100</div>
            <div id="chip-500" class="chip-setup" style="top:48%; right:11.5%;" onclick="selChip(500)">500</div>
            <div id="chip-1000" class="chip-setup" style="top:48%; right:6%;" onclick="selChip(1000)">1K</div>
            <div id="chip-5000" class="chip-setup" style="top:48%; right:0.5%;" onclick="selChip(5000)">5K</div>

            <!-- Number Setup 0-9 -->
            <div id="num-0" class="num-setup"
                 ontouchstart="startHoldBet(0); event.preventDefault();"
                 ontouchend="stopHoldBet()"
                 ontouchcancel="stopHoldBet()"
                 onmousedown="startHoldBetDesktop(0)"
                 onmouseup="stopHoldBetDesktop()"
                 onmouseleave="stopHoldBetDesktop()">
                <div id="b-0" class="bet-amt">0</div>
            </div>

            <div id="num-1" class="num-setup"
                 ontouchstart="startHoldBet(1); event.preventDefault();"
                 ontouchend="stopHoldBet()"
                 ontouchcancel="stopHoldBet()"
                 onmousedown="startHoldBetDesktop(1)"
                 onmouseup="stopHoldBetDesktop()"
                 onmouseleave="stopHoldBetDesktop()">
                <div id="b-1" class="bet-amt">0</div>
            </div>

            <div id="num-2" class="num-setup"
                 ontouchstart="startHoldBet(2); event.preventDefault();"
                 ontouchend="stopHoldBet()"
                 ontouchcancel="stopHoldBet()"
                 onmousedown="startHoldBetDesktop(2)"
                 onmouseup="stopHoldBetDesktop()"
                 onmouseleave="stopHoldBetDesktop()">
                <div id="b-2" class="bet-amt">0</div>
            </div>

            <div id="num-3" class="num-setup"
                 ontouchstart="startHoldBet(3); event.preventDefault();"
                 ontouchend="stopHoldBet()"
                 ontouchcancel="stopHoldBet()"
                 onmousedown="startHoldBetDesktop(3)"
                 onmouseup="stopHoldBetDesktop()"
                 onmouseleave="stopHoldBetDesktop()">
                <div id="b-3" class="bet-amt">0</div>
            </div>

            <div id="num-4" class="num-setup"
                 ontouchstart="startHoldBet(4); event.preventDefault();"
                 ontouchend="stopHoldBet()"
                 ontouchcancel="stopHoldBet()"
                 onmousedown="startHoldBetDesktop(4)"
                 onmouseup="stopHoldBetDesktop()"
                 onmouseleave="stopHoldBetDesktop()">
                <div id="b-4" class="bet-amt">0</div>
            </div>

            <div id="num-5" class="num-setup"
                 ontouchstart="startHoldBet(5); event.preventDefault();"
                 ontouchend="stopHoldBet()"
                 ontouchcancel="stopHoldBet()"
                 onmousedown="startHoldBetDesktop(5)"
                 onmouseup="stopHoldBetDesktop()"
                 onmouseleave="stopHoldBetDesktop()">
                <div id="b-5" class="bet-amt">0</div>
            </div>

            <div id="num-6" class="num-setup"
                 ontouchstart="startHoldBet(6); event.preventDefault();"
                 ontouchend="stopHoldBet()"
                 ontouchcancel="stopHoldBet()"
                 onmousedown="startHoldBetDesktop(6)"
                 onmouseup="stopHoldBetDesktop()"
                 onmouseleave="stopHoldBetDesktop()">
                <div id="b-6" class="bet-amt">0</div>
            </div>

            <div id="num-7" class="num-setup"
                 ontouchstart="startHoldBet(7); event.preventDefault();"
                 ontouchend="stopHoldBet()"
                 ontouchcancel="stopHoldBet()"
                 onmousedown="startHoldBetDesktop(7)"
                 onmouseup="stopHoldBetDesktop()"
                 onmouseleave="stopHoldBetDesktop()">
                <div id="b-7" class="bet-amt">0</div>
            </div>

            <div id="num-8" class="num-setup"
                 ontouchstart="startHoldBet(8); event.preventDefault();"
                 ontouchend="stopHoldBet()"
                 ontouchcancel="stopHoldBet()"
                 onmousedown="startHoldBetDesktop(8)"
                 onmouseup="stopHoldBetDesktop()"
                 onmouseleave="stopHoldBetDesktop()">
                <div id="b-8" class="bet-amt">0</div>
            </div>

            <div id="num-9" class="num-setup"
                 ontouchstart="startHoldBet(9); event.preventDefault();"
                 ontouchend="stopHoldBet()"
                 ontouchcancel="stopHoldBet()"
                 onmousedown="startHoldBetDesktop(9)"
                 onmouseup="stopHoldBetDesktop()"
                 onmouseleave="stopHoldBetDesktop()">
                <div id="b-9" class="bet-amt">0</div>
            </div>
        </div>
    </div>

    <!-- Transfer Modal -->
    <div id="transferModal">
        <div class="new-modal-box">
            <div class="m-header">POINT TRANSFER</div>
            <div class="m-content">
                <div class="m-row">
                    <div class="m-label">TO ACCOUNT NO</div>
                    <input type="text" id="targetId" class="m-input-field">
                </div>
                <div class="m-row">
                    <div class="m-label">PIN</div>
                    <input type="password" id="transferPin" class="m-input-field">
                </div>
                <div class="m-row">
                    <div class="m-label">AMOUNT</div>
                    <input type="number" id="transferAmt" class="m-input-field">
                </div>
            </div>
            <div class="m-btn-container">
                <button class="m-btn" onclick="executeRealTransfer()">TRANSFER</button>
                <button class="m-btn" onclick="closeTransferModal()">CLOSE</button>
            </div>
            <div style="text-align:center; padding-bottom:15px;">RESPONSE: <span id="modalResMsg"></span></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="binary_bridge.js"></script>
    <script src="script.js"></script>
</body>
</html>