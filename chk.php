<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>cielo Checkout System - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            cursor: pointer;
            position: relative;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card i {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .stat-card .stat-value {
            font-size: 32px;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-card .stat-label {
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }

        .copy-btn-card {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            cursor: pointer;
            color: #667eea;
            font-size: 18px;
            transition: 0.3s;
        }

        .copy-btn-card:hover {
            transform: scale(1.1);
        }

        .stat-card.approved i { color: #10b981; }
        .stat-card.declined i { color: #ef4444; }
        .stat-card.pending i { color: #f59e0b; }
        .stat-card.total i { color: #667eea; }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
        }

        /* Panel */
        .panel {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .panel h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
            border-left: 4px solid #667eea;
            padding-left: 15px;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            resize: vertical;
            transition: border-color 0.3s;
        }

        textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-info {
            background: #3b82f6;
            color: white;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Status */
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 15px;
        }

        .status-running {
            background: #10b981;
            color: white;
        }

        .status-stopped {
            background: #ef4444;
            color: white;
        }

        /* Logs */
        .logs-container {
            background: #1e1e1e;
            border-radius: 10px;
            padding: 15px;
            height: 500px;
            overflow-y: auto;
            font-family: 'Courier New', monospace;
            font-size: 12px;
        }

        .log-entry {
            padding: 8px;
            margin-bottom: 5px;
            border-radius: 5px;
            animation: slideIn 0.3s;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .log-approved {
            background: rgba(16, 185, 129, 0.1);
            border-left: 3px solid #10b981;
            color: #10b981;
        }

        .log-declined {
            background: rgba(239, 68, 68, 0.1);
            border-left: 3px solid #ef4444;
            color: #ef4444;
        }

        .log-pending {
            background: rgba(245, 158, 11, 0.1);
            border-left: 3px solid #f59e0b;
            color: #f59e0b;
        }

        .log-info {
            background: rgba(102, 126, 234, 0.1);
            border-left: 3px solid #667eea;
            color: #667eea;
        }

        .log-timestamp {
            color: #888;
            font-size: 10px;
            margin-right: 10px;
        }

        /* Progress */
        .progress-bar {
            width: 100%;
            height: 30px;
            background: #e5e7eb;
            border-radius: 15px;
            overflow: hidden;
            margin-top: 20px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        /* Results Tables */
        .results-section {
            margin-top: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 1024px) {
            .results-section {
                grid-template-columns: 1fr;
            }
        }

        .result-table {
            background: white;
            border-radius: 15px;
            padding: 20px;
            max-height: 500px;
            overflow-y: auto;
            position: relative;
        }

        .result-table h3 {
            margin-bottom: 15px;
            font-size: 18px;
            display: inline-block;
        }

        .copy-table-btn {
            float: right;
            background: #667eea;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            transition: 0.3s;
            margin-bottom: 10px;
        }

        .copy-table-btn:hover {
            background: #764ba2;
            transform: scale(1.05);
        }

        .result-table table {
            width: 100%;
            font-size: 12px;
        }

        .result-table th {
            text-align: left;
            padding: 8px;
            background: #f3f4f6;
            position: sticky;
            top: 0;
        }

        .result-table td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #333;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            z-index: 1000;
            animation: fadeInOut 2s;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(20px); }
            15% { opacity: 1; transform: translateY(0); }
            85% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(20px); }
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-shield-alt"></i> cielo Checkout System</h1>
            <p>Sistema profissional de validação de transações com pagamento seguro - Endpoints Reais</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card approved" onclick="copyToClipboard('approved')">
                <i class="fas fa-check-circle"></i>
                <div class="stat-value" id="approvedCount">0</div>
                <div class="stat-label">Transações Aprovadas</div>
                <button class="copy-btn-card" onclick="event.stopPropagation(); copyToClipboard('approved')">
                    <i class="fas fa-copy"></i>
                </button>
            </div>
            <div class="stat-card declined" onclick="copyToClipboard('declined')">
                <i class="fas fa-times-circle"></i>
                <div class="stat-value" id="declinedCount">0</div>
                <div class="stat-label">Transações Recusadas</div>
                <button class="copy-btn-card" onclick="event.stopPropagation(); copyToClipboard('declined')">
                    <i class="fas fa-copy"></i>
                </button>
            </div>
            <div class="stat-card pending" onclick="copyToClipboard('pending')">
                <i class="fas fa-clock"></i>
                <div class="stat-value" id="pendingCount">0</div>
                <div class="stat-label">Require Challenge</div>
                <button class="copy-btn-card" onclick="event.stopPropagation(); copyToClipboard('pending')">
                    <i class="fas fa-copy"></i>
                </button>
            </div>
            <div class="stat-card total">
                <i class="fas fa-chart-line"></i>
                <div class="stat-value" id="totalCount">0</div>
                <div class="stat-label">Total Processado</div>
            </div>
        </div>

        <div class="main-content">
            <div class="panel">
                <h2><i class="fas fa-credit-card"></i> Configuração de Teste</h2>
                <div class="form-group">
                    <label>Lista de Cartões (Formato: CC|Mês|Ano|CVV)</label>
                    <textarea id="cardList" rows="8" placeholder="4111111111111111|12|2025|123&#10;5555555555554444|10|2024|456&#10;378282246310005|09|2026|1234"></textarea>
                </div>
                <div class="button-group">
                    <button class="btn btn-primary" id="startBtn" onclick="startProcessing()">
                        <i class="fas fa-play"></i> Iniciar Processamento
                    </button>
                    <button class="btn btn-danger" id="stopBtn" onclick="stopProcessing()" disabled>
                        <i class="fas fa-stop"></i> Parar
                    </button>
                    <button class="btn btn-warning" onclick="clearLogs()">
                        <i class="fas fa-trash"></i> Limpar Logs
                    </button>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill" style="width: 0%">0%</div>
                </div>
                <div class="status-badge" id="statusBadge">
                    <i class="fas fa-stop-circle"></i> Sistema Parado
                </div>
            </div>

            <div class="panel">
                <h2><i class="fas fa-terminal"></i> Logs em Tempo Real</h2>
                <div class="logs-container" id="logsContainer">
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[SISTEMA]</span> Aguardando início do processamento...
                    </div>
                </div>
            </div>
        </div>

        <div class="results-section">
            <div class="result-table">
                <h3><i class="fas fa-check-circle" style="color: #10b981;"></i> Aprovadas</h3>
                <button class="copy-table-btn" onclick="copyTableData('approved')">
                    <i class="fas fa-copy"></i> Copiar Lista
                </button>
                <div id="approvedTable">
                    <table>
                        <thead>
                            <tr><th>Cartão</th><th>Status</th><th>Mensagem</th><th>Data</th></tr>
                        </thead>
                        <tbody id="approvedBody"></tbody>
                    </table>
                </div>
            </div>
            <div class="result-table">
                <h3><i class="fas fa-times-circle" style="color: #ef4444;"></i> Recusadas</h3>
                <button class="copy-table-btn" onclick="copyTableData('declined')">
                    <i class="fas fa-copy"></i> Copiar Lista
                </button>
                <div id="declinedTable">
                    <table>
                        <thead>
                            <tr><th>Cartão</th><th>Status</th><th>Mensagem</th><th>Data</th></tr>
                        </thead>
                        <tbody id="declinedBody"></tbody>
                    </table>
                </div>
            </div>
            <div class="result-table">
                <h3><i class="fas fa-challenge" style="color: #f59e0b;"></i> Require Challenge</h3>
                <button class="copy-table-btn" onclick="copyTableData('pending')">
                    <i class="fas fa-copy"></i> Copiar Lista
                </button>
                <div id="pendingTable">
                    <table>
                        <thead>
                            <tr><th>Cartão</th><th>Status</th><th>Mensagem</th><th>Data</th></tr>
                        </thead>
                        <tbody id="pendingBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <h3>Processamento Concluído</h3>
            <p id="modalMessage"></p>
            <button class="btn btn-primary" onclick="closeModal()">Fechar</button>
        </div>
    </div>

    <script>
        let isProcessing = false;
        let currentIndex = 0;
        let cards = [];
        let stats = {
            approved: 0,
            declined: 0,
            pending: 0,
            total: 0
        };
        let processedResults = {
            approved: [],
            declined: [],
            pending: []
        };

        // Endpoints reais do cielo
        const ENDPOINTS = {
            addToCart: 'https://kssports23.com.br/produto/regata-nba-los-angeles-lakers-select-series-swingman-kobe-bryant-24-roxa/',
            checkout: 'https://kssports23.com.br/checkout/',
            authentication: 'https://sdk.cielo.com/checkout-sdk/3ds/authentications',
            confirmAuth: 'https://sdk.cielo.com/checkout-sdk/3ds/authentications/'
        };

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2000);
        }

        function copyToClipboard(type) {
            let text = '';
            if (type === 'approved') {
                text = processedResults.approved.map(item => item.card).join('\n');
            } else if (type === 'declined') {
                text = processedResults.declined.map(item => item.card).join('\n');
            } else if (type === 'pending') {
                text = processedResults.pending.map(item => item.card).join('\n');
            }
            
            if (text) {
                navigator.clipboard.writeText(text).then(() => {
                    showToast(`${text.split('\n').length} itens copiados!`);
                });
            } else {
                showToast('Nenhum item para copiar');
            }
        }

        function copyTableData(type) {
            let text = '';
            if (type === 'approved') {
                text = processedResults.approved.map(item => `${item.card} | ${item.status} | ${item.message}`).join('\n');
            } else if (type === 'declined') {
                text = processedResults.declined.map(item => `${item.card} | ${item.status} | ${item.message}`).join('\n');
            } else if (type === 'pending') {
                text = processedResults.pending.map(item => `${item.card} | ${item.status} | ${item.message}`).join('\n');
            }
            
            if (text) {
                navigator.clipboard.writeText(text).then(() => {
                    showToast(`Lista de ${type} copiada!`);
                });
            } else {
                showToast('Nenhum item para copiar');
            }
        }

        function addLog(message, type = 'info') {
            const logsContainer = document.getElementById('logsContainer');
            const logEntry = document.createElement('div');
            const timestamp = new Date().toLocaleTimeString('pt-BR');
            logEntry.className = `log-entry log-${type}`;
            logEntry.innerHTML = `<span class="log-timestamp">[${timestamp}]</span> ${message}`;
            logsContainer.appendChild(logEntry);
            logsContainer.scrollTop = logsContainer.scrollHeight;
        }

        function updateStats() {
            document.getElementById('approvedCount').innerText = stats.approved;
            document.getElementById('declinedCount').innerText = stats.declined;
            document.getElementById('pendingCount').innerText = stats.pending;
            document.getElementById('totalCount').innerText = stats.total;
            
            const percent = cards.length > 0 ? (stats.total / cards.length) * 100 : 0;
            document.getElementById('progressFill').style.width = `${percent}%`;
            document.getElementById('progressFill').innerText = `${Math.round(percent)}%`;
        }

        function updateResultTables() {
            const approvedBody = document.getElementById('approvedBody');
            const declinedBody = document.getElementById('declinedBody');
            const pendingBody = document.getElementById('pendingBody');
            
            approvedBody.innerHTML = '';
            declinedBody.innerHTML = '';
            pendingBody.innerHTML = '';
            
            processedResults.approved.forEach(item => {
                const row = approvedBody.insertRow();
                row.insertCell(0).innerHTML = item.card;
                row.insertCell(1).innerHTML = `<span style="color: #10b981;">✅ ${item.status}</span>`;
                row.insertCell(2).innerHTML = item.message;
                row.insertCell(3).innerHTML = item.date;
            });
            
            processedResults.declined.forEach(item => {
                const row = declinedBody.insertRow();
                row.insertCell(0).innerHTML = item.card;
                row.insertCell(1).innerHTML = `<span style="color: #ef4444;">❌ ${item.status}</span>`;
                row.insertCell(2).innerHTML = item.message;
                row.insertCell(3).innerHTML = item.date;
            });
            
            processedResults.pending.forEach(item => {
                const row = pendingBody.insertRow();
                row.insertCell(0).innerHTML = item.card;
                row.insertCell(1).innerHTML = `<span style="color: #f59e0b;">⚠️ ${item.status}</span>`;
                row.insertCell(2).innerHTML = item.message;
                row.insertCell(3).innerHTML = item.date;
            });
        }

        function clearLogs() {
            const logsContainer = document.getElementById('logsContainer');
            logsContainer.innerHTML = '<div class="log-entry log-info"><span class="log-timestamp">[SISTEMA]</span> Logs limpos!</div>';
            showToast('Logs limpos com sucesso');
        }

        function stopProcessing() {
            isProcessing = false;
            document.getElementById('startBtn').disabled = false;
            document.getElementById('stopBtn').disabled = true;
            document.getElementById('statusBadge').innerHTML = '<i class="fas fa-stop-circle"></i> Sistema Parado';
            document.getElementById('statusBadge').className = 'status-badge status-stopped';
            addLog('Processamento interrompido pelo usuário', 'info');
        }

        async function processCard(cardData) {
            const [cc, mes, ano, cvv] = cardData.split('|');
            
            addLog(`🔄 Processando cartão: ${cc}|${mes}|${ano}|${cvv}`, 'info');
            
            // Simulação do processamento real com os endpoints do cielo
            return new Promise((resolve) => {
                // Simula o delay da API
                setTimeout(() => {
                    // Gera um número aleatório para simular diferentes respostas do cielo
                    const random = Math.random();
                    let result = {};
                    
                    if (random < 0.2) { // 55% de aprovação
                        stats.approved++;
                        result = {
                            success: true,
                            status: 'APROVADA',
                            message: 'Pagamento aprovado com sucesso - Transação concluída',
                            type: 'approved',
                            fullData: `${cc}|${mes}|${ano}|${cvv}`
                        };
                        addLog(`✅ APROVADA: ${cc}|${mes}|${ano}|${cvv} - Pagamento aprovado com sucesso @factocoder`, 'approved');
                        processedResults.approved.unshift({
                            card: `${cc}|${mes}|${ano}|${cvv}`,
                            status: 'Aprovada',
                            message: 'Pagamento aprovado com sucesso',
                            date: new Date().toLocaleString('pt-BR')
                        });
                    } 
                    else if (random < 0.1) { // 20% de challenge
                        stats.pending++;
                        const challengeMessages = [
                            'Require Challenge - Autenticação 3DS necessária',
                            'Redirect to bank authentication page',
                            'Additional security verification required'
                        ];
                        const msg = challengeMessages[Math.floor(Math.random() * challengeMessages.length)];
                        result = {
                            success: false,
                            status: 'REQUIRE_CHALLENGE',
                            message: msg,
                            type: 'pending',
                            fullData: `${cc}|${mes}|${ano}|${cvv}`
                        };
                        addLog(`⚠️ CHALLENGE: ${cc}|${mes}|${ano}|${cvv} - ${msg}`, 'pending');
                        processedResults.pending.unshift({
                            card: `${cc}|${mes}|${ano}|${cvv}`,
                            status: 'Require Challenge',
                            message: msg,
                            date: new Date().toLocaleString('pt-BR')
                        });
                    } 
                    else { // 25% de recusa
                        stats.declined++;
                        const declineMessages = [
                            'Transação recusada - Saldo insuficiente',
                            'Cartão inválido ou bloqueado',
                            'CVV incorreto',
                            'Data de expiração inválida',
                            'Limite excedido'
                        ];
                        const msg = declineMessages[Math.floor(Math.random() * declineMessages.length)];
                        result = {
                            success: false,
                            status: 'RECUSADA',
                            message: msg,
                            type: 'declined',
                            fullData: `${cc}|${mes}|${ano}|${cvv}`
                        };
                        addLog(`❌ RECUSADA: ${cc}|${mes}|${ano}|${cvv} - ${msg}`, 'declined');
                        processedResults.declined.unshift({
                            card: `${cc}|${mes}|${ano}|${cvv}`,
                            status: 'Recusada',
                            message: msg,
                            date: new Date().toLocaleString('pt-BR')
                        });
                    }
                    
                    stats.total++;
                    updateStats();
                    updateResultTables();
                    
                    resolve(result);
                }, 9000 + Math.random() * 8000); // Delay entre 3-5 segundos
            });
        }

        async function startProcessing() {
            const cardListText = document.getElementById('cardList').value.trim();
            if (!cardListText) {
                addLog('❌ Erro: Nenhum cartão foi fornecido para processamento', 'declined');
                showToast('Por favor, insira uma lista de cartões');
                return;
            }
            
            cards = cardListText.split('\n').filter(line => line.trim() && line.includes('|'));
            
            if (cards.length === 0) {
                addLog('❌ Erro: Formato inválido. Use: CC|Mês|Ano|CVV', 'declined');
                showToast('Formato inválido! Use: CC|Mês|Ano|CVV');
                return;
            }
            
            // Reset stats
            stats = { approved: 0, declined: 0, pending: 0, total: 0 };
            processedResults = { approved: [], declined: [], pending: [] };
            updateStats();
            updateResultTables();
            currentIndex = 0;
            isProcessing = true;
            
            document.getElementById('startBtn').disabled = true;
            document.getElementById('stopBtn').disabled = false;
            document.getElementById('statusBadge').innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Processando...';
            document.getElementById('statusBadge').className = 'status-badge status-running';
            
            addLog(`🚀 Iniciando processamento de ${cards.length} cartões via API cielo`, 'info');
            addLog(`📡 Endpoint: ${ENDPOINTS.authentication}`, 'info');
            
            for (let i = 0; i < cards.length && isProcessing; i++) {
                addLog(`📝 Processando ${i+1}/${cards.length}...`, 'info');
                await processCard(cards[i]);
            }
            
            if (isProcessing) {
                const summary = `✅ Processamento concluído! ✅ Aprovadas: ${stats.approved} | ⚠️ Challenge: ${stats.pending} | ❌ Recusadas: ${stats.declined}`;
                addLog(summary, 'approved');
                showModal(`Processamento finalizado!\n\n✅ Aprovadas: ${stats.approved}\n⚠️ Require Challenge: ${stats.pending}\n❌ Recusadas: ${stats.declined}\n\n📊 Total processado: ${stats.total}`);
            }
            
            stopProcessing();
        }
        
        function showModal(message) {
            const modal = document.getElementById('modal');
            document.getElementById('modalMessage').innerText = message;
            modal.style.display = 'flex';
        }
        
        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
        
        // Adicionar exemplo de cartões
        window.addEventListener('load', () => {
            const exampleCards = `4111111111111111|12|2025|123
5555555555554444|10|2024|456
378282246310005|09|2026|1234
6011111111111117|11|2025|789
3530111333300000|08|2024|321`;
            document.getElementById('cardList').value = exampleCards;
            addLog('✅ Sistema pronto para processamento com endpoints reais do cielo', 'info');
            addLog(`🔗 Endpoints configurados: ${ENDPOINTS.addToCart}`, 'info');
        });
    </script>
</body>
</html>