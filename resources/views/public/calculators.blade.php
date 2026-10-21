@extends('layouts.public')
@section('title', 'Calculadoras Contábeis e Fiscais Gratuitas | Cotech')
@section('description', 'Simule custos de abertura de CNPJ, compare contratação PJ x CLT, calcule o Fator R do Simples Nacional, RPA para autônomos e o impacto da Reforma Tributária.')

@section('content')
<!-- HERO DA PÁGINA DE CALCULADORAS -->
<div class="calc-page-hero">
    <div class="container" data-reveal>
        <span class="eyebrow">FERRAMENTAS & SIMULAÇÕES GRATUITAS</span>
        <h1>Calculadoras Contábeis<br><span class="ink-blue">para o seu negócio.</span></h1>
        <p class="muted">Tome decisões financeiras com segurança. Simule custos de abertura de empresa, compare ganhos entre CLT e PJ, descubra sua alíquota de impostos e muito mais.</p>
    </div>
</div>

<!-- CONTAINER PRINCIPAL DAS CALCULADORAS -->
<section class="section calc-main-section">
    <div class="container">
        <!-- NAVEGAÇÃO DE ABAS ENTRE CALCULADORAS -->
        <div class="calc-nav-tabs" role="tablist" aria-label="Calculadoras disponíveis" data-reveal>
            <button class="calc-tab-btn active" role="tab" id="tab-cnpj" aria-selected="true" aria-controls="calc-panel-cnpj" data-calc="abrir-cnpj">
                <span class="calc-tab-icon">📝</span>
                <span class="calc-tab-title">Custo para Abrir CNPJ</span>
            </button>
            <button class="calc-tab-btn" role="tab" id="tab-clt-pj" aria-selected="false" aria-controls="calc-panel-clt-pj" data-calc="pj-clt">
                <span class="calc-tab-icon">⚖️</span>
                <span class="calc-tab-title">Calculadora PJ x CLT</span>
            </button>
            <button class="calc-tab-btn" role="tab" id="tab-fator-r" aria-selected="false" aria-controls="calc-panel-fator-r" data-calc="fator-r">
                <span class="calc-tab-icon">📊</span>
                <span class="calc-tab-title">Calculadora de Fator R</span>
            </button>
            <button class="calc-tab-btn" role="tab" id="tab-rpa" aria-selected="false" aria-controls="calc-panel-rpa" data-calc="rpa">
                <span class="calc-tab-icon">💼</span>
                <span class="calc-tab-title">Calculadora de RPA</span>
            </button>
            <button class="calc-tab-btn" role="tab" id="tab-reforma" aria-selected="false" aria-controls="calc-panel-reforma" data-calc="reforma-tributaria">
                <span class="calc-tab-icon">🏛️</span>
                <span class="calc-tab-title">Reforma Tributária</span>
            </button>
        </div>

        <!-- CONTEÚDO DAS CALCULADORAS -->
        <div class="calc-panels-wrapper">
            <!-- ==========================================
                 01. CALCULADORA DE CUSTO PARA ABRIR CNPJ
                 ========================================== -->
            <div class="calc-panel active" id="calc-panel-cnpj" role="tabpanel" aria-labelledby="tab-cnpj">
                <div class="calc-card-grid">
                    <div class="calc-inputs-card">
                        <h3>Simule o custo para abrir seu CNPJ</h3>
                        <p class="calc-subtitle">Descubra as taxas governamentais e veja quanto você economiza abrindo com a Cotech.</p>
                        
                        <div class="calc-form-group">
                            <label for="cnpj-uf">Estado de Registro</label>
                            <select id="cnpj-uf" class="calc-input">
                                <option value="SP" selected>São Paulo (SP)</option>
                                <option value="RJ">Rio de Janeiro (RJ)</option>
                                <option value="MG">Minas Gerais (MG)</option>
                                <option value="PR">Paraná (PR)</option>
                                <option value="OUTRO">Outros Estados</option>
                            </select>
                        </div>

                        <div class="calc-form-group">
                            <label for="cnpj-tipo">Tipo de Empresa</label>
                            <select id="cnpj-tipo" class="calc-input">
                                <option value="SLU" selected>Sociedade Limitada Unipessoal (SLU)</option>
                                <option value="LTDA">Sociedade Limitada (LTDA com sócios)</option>
                                <option value="EI">Empresário Individual (EI)</option>
                            </select>
                        </div>

                        <div class="calc-form-group">
                            <label for="cnpj-atividade">Segmento de Atuação</label>
                            <select id="cnpj-atividade" class="calc-input">
                                <option value="servico" selected>Prestação de Serviços / TI / Consultoria</option>
                                <option value="comercio">Comércio Varejista</option>
                            </select>
                        </div>

                        <button type="button" class="button blue-button full-width" id="btn-calc-cnpj">Calcular Custos de Abertura ↗</button>
                    </div>

                    <div class="calc-results-card">
                        <span class="calc-badge-green">RESULTADO ESTIMADO</span>
                        <div class="calc-result-header">
                            <small>Honorários Cotech para abertura:</small>
                            <div class="calc-big-value text-green">R$ 0,00 <span class="tag-free">GRÁTIS</span></div>
                            <p class="calc-note">Não cobramos nada pelo serviço de abertura nos nossos planos de contabilidade.</p>
                        </div>

                        <div class="calc-breakdown-list">
                            <div class="breakdown-item">
                                <span>Taxa Junta Comercial (DARE):</span>
                                <strong id="res-cnpj-junta">R$ 198,00</strong>
                            </div>
                            <div class="breakdown-item">
                                <span>Taxa de Alvará / Prefeitura:</span>
                                <strong id="res-cnpj-alvara">R$ 0,00 (Isento SP)</strong>
                            </div>
                            <div class="breakdown-item">
                                <span>Honorários Contador Tradicional:</span>
                                <strong class="text-strike">R$ 1.200,00</strong>
                            </div>
                            <div class="breakdown-item highlight-saving">
                                <span>Sua economia abrindo na Cotech:</span>
                                <strong class="text-green" id="res-cnpj-economia">R$ 1.200,00</strong>
                            </div>
                        </div>

                        <div class="calc-cta-box">
                            <p><strong>Cuidamos de 100% da burocracia para você.</strong> Sem sair de casa e sem pagar honorários de abertura.</p>
                            <a class="button blue-button full-width" href="/orcamento">Abrir meu CNPJ Grátis ↗</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==========================================
                 02. CALCULADORA PJ x CLT
                 ========================================== -->
            <div class="calc-panel" id="calc-panel-clt-pj" role="tabpanel" aria-labelledby="tab-clt-pj" hidden>
                <div class="calc-card-grid">
                    <div class="calc-inputs-card">
                        <h3>Compare seu Salário: PJ vs CLT</h3>
                        <p class="calc-subtitle">Descubra quanto você realmente ganharia líquido como PJ comparado ao modelo CLT.</p>
                        
                        <div class="calc-form-group">
                            <label for="clt-bruto">Salário Bruto CLT (R$)</label>
                            <input type="number" id="clt-bruto" class="calc-input" value="8000" min="1500" step="100">
                        </div>

                        <div class="calc-form-group">
                            <label for="clt-beneficios">Benefícios Mensais CLT (VR, VA, Saúde em R$)</label>
                            <input type="number" id="clt-beneficios" class="calc-input" value="1200" min="0" step="50">
                        </div>

                        <div class="calc-form-group">
                            <label for="pj-faturamento">Pretensão de Faturamento PJ Mensal (R$)</label>
                            <input type="number" id="pj-faturamento" class="calc-input" value="12000" min="2000" step="500">
                            <small class="calc-tip">Dica de mercado: Geralmente o valor PJ costuma ser 1.4x a 1.7x o salário CLT.</small>
                        </div>

                        <button type="button" class="button blue-button full-width" id="btn-calc-clt-pj">Comparar Ganhos Líquidos ↗</button>
                    </div>

                    <div class="calc-results-card">
                        <span class="calc-badge-green">COMPARATIVO LÍQUIDO NO BOLSO</span>

                        <div class="clt-pj-comparison-grid">
                            <!-- CLT -->
                            <div class="comparison-column clt-col">
                                <span class="comp-tag">COMO CLT</span>
                                <div class="comp-value" id="res-clt-liquido">R$ 6.320,00</div>
                                <small>Líquido mensal (após INSS e IRPF)</small>
                                <ul class="comp-details">
                                    <li>Desconto INSS: <span id="res-clt-inss">- R$ 908,00</span></li>
                                    <li>Desconto IRPF: <span id="res-clt-irpf">- R$ 772,00</span></li>
                                    <li>Total Anual c/ 13º/Férias: <strong id="res-clt-anual">R$ 88.400</strong></li>
                                </ul>
                            </div>

                            <!-- PJ -->
                            <div class="comparison-column pj-col">
                                <span class="comp-tag pj-tag">COMO PJ NA COTECH</span>
                                <div class="comp-value text-green" id="res-pj-liquido">R$ 10.820,00</div>
                                <small>Líquido mensal no bolso</small>
                                <ul class="comp-details">
                                    <li>Imposto Simples (6% Anexo III): <span id="res-pj-imposto">- R$ 720,00</span></li>
                                    <li>Pró-labore + INSS otimizado: <span id="res-pj-inss">- R$ 460,00</span></li>
                                    <li>Total Anual Líquido: <strong class="text-green" id="res-pj-anual">R$ 129.840</strong></li>
                                </ul>
                            </div>
                        </div>

                        <div class="calc-winner-banner">
                            <span class="winner-icon">🚀</span>
                            <div>
                                <strong>Ganho Extra como PJ: <span class="text-green" id="res-pj-diferenca">+ R$ 41.440 / ano</span></strong>
                                <p>Com a otimização tributária da Cotech no Anexo III, você mantém muito mais dinheiro com você.</p>
                            </div>
                        </div>

                        <div class="calc-cta-box">
                            <a class="button blue-button full-width" href="/orcamento">Fazer Transição para PJ com a Cotech ↗</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==========================================
                 03. CALCULADORA DE FATOR R
                 ========================================== -->
            <div class="calc-panel" id="calc-panel-fator-r" role="tabpanel" aria-labelledby="tab-fator-r" hidden>
                <div class="calc-card-grid">
                    <div class="calc-inputs-card">
                        <h3>Calcule o Fator R da sua Empresa</h3>
                        <p class="calc-subtitle">Descubra se sua empresa pode pagar 6% de imposto (Anexo III) em vez de 15,5% (Anexo V).</p>
                        
                        <div class="calc-form-group">
                            <label for="fator-faturamento">Faturamento Médio Mensal (R$)</label>
                            <input type="number" id="fator-faturamento" class="calc-input" value="20000" min="1000" step="500">
                        </div>

                        <div class="calc-form-group">
                            <label for="fator-folha">Folha de Pagamento Total Mensal (Pró-labore + Salários em R$)</label>
                            <input type="number" id="fator-folha" class="calc-input" value="6000" min="0" step="200">
                            <small class="calc-tip">Inclui salários de funcionários, encargos e o pró-labore retirado pelos sócios.</small>
                        </div>

                        <button type="button" class="button blue-button full-width" id="btn-calc-fator">Calcular Fator R ↗</button>
                    </div>

                    <div class="calc-results-card">
                        <span class="calc-badge-green">ENQUADRAMENTO FISCAL</span>
                        <div class="calc-result-header">
                            <small>Seu Fator R Calculado:</small>
                            <div class="calc-big-value" id="res-fator-percent">30,0%</div>
                            <div class="fator-badge-status" id="res-fator-badge">ANEXO III - 6% DE IMPOSTO</div>
                        </div>

                        <div class="calc-breakdown-list">
                            <div class="breakdown-item">
                                <span>Alíquota Inicial Aplicada:</span>
                                <strong id="res-fator-aliquota">6,0% (Anexo III)</strong>
                            </div>
                            <div class="breakdown-item">
                                <span>Imposto Mensal Estimado:</span>
                                <strong id="res-fator-imposto">R$ 1.200,00</strong>
                            </div>
                            <div class="breakdown-item">
                                <span>Imposto no Anexo V (sem Fator R):</span>
                                <strong class="text-strike" id="res-fator-anexo5">R$ 3.100,00</strong>
                            </div>
                            <div class="breakdown-item highlight-saving">
                                <span>Economia Mensal com a Cotech:</span>
                                <strong class="text-green" id="res-fator-economia">R$ 1.900,00 / mês</strong>
                            </div>
                        </div>

                        <div class="calc-fator-advice" id="res-fator-advice">
                            <p>✓ <strong>Excelente!</strong> Seu Fator R está igual ou superior a 28%. A Cotech garante a apuração correta para você recolher apenas 6% de imposto.</p>
                        </div>

                        <div class="calc-cta-box">
                            <a class="button blue-button full-width" href="/orcamento">Otimizar Meus Impostos na Cotech ↗</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==========================================
                 04. CALCULADORA DE RPA ONLINE
                 ========================================== -->
            <div class="calc-panel" id="calc-panel-rpa" role="tabpanel" aria-labelledby="tab-rpa" hidden>
                <div class="calc-card-grid">
                    <div class="calc-inputs-card">
                        <h3>Calculadora de RPA para Autônomos</h3>
                        <p class="calc-subtitle">Veja quanto você perde em retenções de INSS, IRRF e ISS emitindo como pessoa física (RPA).</p>
                        
                        <div class="calc-form-group">
                            <label for="rpa-bruto">Valor Bruto do Serviço (R$)</label>
                            <input type="number" id="rpa-bruto" class="calc-input" value="7000" min="500" step="200">
                        </div>

                        <div class="calc-form-group">
                            <label for="rpa-dependentes">Número de Dependentes</label>
                            <input type="number" id="rpa-dependentes" class="calc-input" value="0" min="0" max="10">
                        </div>

                        <div class="calc-form-group">
                            <label for="rpa-iss">Alíquota de ISS da sua Cidade (%)</label>
                            <select id="rpa-iss" class="calc-input">
                                <option value="0.05" selected>5% (Maioria das capitais)</option>
                                <option value="0.02">2% (Mínimo nacional)</option>
                                <option value="0.03">3%</option>
                            </select>
                        </div>

                        <button type="button" class="button blue-button full-width" id="btn-calc-rpa">Calcular Descontos de RPA ↗</button>
                    </div>

                    <div class="calc-results-card">
                        <span class="calc-badge-green">RETENÇÕES NO RECIBO RPA</span>
                        <div class="calc-result-header">
                            <small>Valor Líquido que você recebe no RPA:</small>
                            <div class="calc-big-value text-red" id="res-rpa-liquido">R$ 5.012,00</div>
                            <p class="calc-note">Você perde quase 30% do seu trabalho emitindo RPA para empresas.</p>
                        </div>

                        <div class="calc-breakdown-list">
                            <div class="breakdown-item">
                                <span>Retenção INSS (11% com teto):</span>
                                <strong id="res-rpa-inss">- R$ 770,00</strong>
                            </div>
                            <div class="breakdown-item">
                                <span>Retenção IRRF (Tabela Progressiva):</span>
                                <strong id="res-rpa-irrf">- R$ 868,00</strong>
                            </div>
                            <div class="breakdown-item">
                                <span>Retenção ISS Municipal:</span>
                                <strong id="res-rpa-iss">- R$ 350,00</strong>
                            </div>
                            <div class="breakdown-item highlight-saving">
                                <span>Como PJ Cotech você pagaria apenas:</span>
                                <strong class="text-green" id="res-rpa-pj">R$ 420,00 (6%)</strong>
                            </div>
                        </div>

                        <div class="calc-winner-banner">
                            <span class="winner-icon">💡</span>
                            <div>
                                <strong>Pare de perder dinheiro no RPA:</strong>
                                <p>Abrindo um CNPJ com a Cotech você economiza <strong class="text-green" id="res-rpa-economia">R$ 1.568,00</strong> todo mês!</p>
                            </div>
                        </div>

                        <div class="calc-cta-box">
                            <a class="button blue-button full-width" href="/orcamento">Abrir CNPJ e Economizar Impostos ↗</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==========================================
                 05. CALCULADORA DE REFORMA TRIBUTÁRIA
                 ========================================== -->
            <div class="calc-panel" id="calc-panel-reforma" role="tabpanel" aria-labelledby="tab-reforma" hidden>
                <div class="calc-card-grid">
                    <div class="calc-inputs-card">
                        <h3>Simulador da Reforma Tributária (IBS / CBS)</h3>
                        <p class="calc-subtitle">Entenda o impacto da transição do PIS, COFINS e ISS para o novo IVA Dual na sua empresa.</p>
                        
                        <div class="calc-form-group">
                            <label for="ref-faturamento">Faturamento Anual da Empresa (R$)</label>
                            <input type="number" id="ref-faturamento" class="calc-input" value="360000" min="50000" step="10000">
                        </div>

                        <div class="calc-form-group">
                            <label for="ref-regime">Regime Tributário Atual</label>
                            <select id="ref-regime" class="calc-input">
                                <option value="simples" selected>Simples Nacional</option>
                                <option value="presumido">Lucro Presumido</option>
                            </select>
                        </div>

                        <div class="calc-form-group">
                            <label for="ref-modelo">Tipo de Cliente Predominante</label>
                            <select id="ref-modelo" class="calc-input">
                                <option value="b2b" selected>B2B (Vende para outras empresas)</option>
                                <option value="b2c">B2C (Vende para consumidor final)</option>
                            </select>
                        </div>

                        <button type="button" class="button blue-button full-width" id="btn-calc-reforma">Simular Impacto da Reforma ↗</button>
                    </div>

                    <div class="calc-results-card">
                        <span class="calc-badge-green">DIAGNÓSTICO E TRANSIÇÃO</span>
                        <div class="calc-result-header">
                            <small>Impacto Estimado na sua Empresa:</small>
                            <div class="calc-big-value text-blue" id="res-ref-status">Vantagem Competitiva</div>
                            <p class="calc-note" id="res-ref-summary">No Simples Nacional você mantém a tributação simplificada com opção de transferir créditos aos seus clientes B2B.</p>
                        </div>

                        <div class="calc-breakdown-list">
                            <div class="breakdown-item">
                                <span>Regime Recomendado:</span>
                                <strong id="res-ref-recomendado">Simples Nacional Otimizado</strong>
                            </div>
                            <div class="breakdown-item">
                                <span>Geração de Créditos B2B:</span>
                                <strong id="res-ref-creditos">Habilitada com IBS/CBS</strong>
                            </div>
                            <div class="breakdown-item">
                                <span>Segurança Fiscal:</span>
                                <strong>100% Assegurada com a Cotech</strong>
                            </div>
                        </div>

                        <div class="calc-winner-banner">
                            <span class="winner-icon">🛡️</span>
                            <div>
                                <strong>Assessoria Estratégica Cotech:</strong>
                                <p>Nossa equipe faz o planejamento prévio para que sua empresa se beneficie das novas regras fiscais sem aumento de carga tributária.</p>
                            </div>
                        </div>

                        <div class="calc-cta-box">
                            <a class="button blue-button full-width" href="/orcamento">Falar com Consultor Tributário ↗</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION CALLOUT / FALE COM A COTECH -->
<section class="section">
    <div class="container" data-reveal>
        <div class="srv-callout-card">
            <div class="srv-callout-content">
                <span class="srv-callout-tag">PLANEJAMENTO PERSONALIZADO</span>
                <h2>Precisa de uma análise detalhada dos seus números?</h2>
                <p>Nossos contadores certificados avaliam o perfil do seu negócio, simulam o melhor enquadramento e garantem economia real para sua empresa.</p>
                <div class="srv-callout-actions">
                    <a class="button blue-button" href="/orcamento">Solicitar Proposta Sob Medida <span>↗</span></a>
                    <a class="button srv-button-ghost" href="/servicos">Conheça Nossos Serviços <span>↗</span></a>
                </div>
            </div>
            <div class="srv-callout-image">
                <img src="/images/specialist-tablet.jpg" alt="Consultor Cotech disponível para atendimento" width="460" height="420" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- JAVASCRIPT DINÂMICO PARA CÁLCULOS E NAVEGAÇÃO -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Alternador de abas entre as calculadoras
    const calcTabs = document.querySelectorAll('.calc-tab-btn');
    const calcPanels = document.querySelectorAll('.calc-panel');

    function selectCalc(calcId) {
        calcTabs.forEach(btn => {
            const match = btn.getAttribute('data-calc') === calcId;
            btn.classList.toggle('active', match);
            btn.setAttribute('aria-selected', String(match));
        });
        calcPanels.forEach(panel => {
            const match = panel.id === 'calc-panel-' + calcId;
            panel.classList.toggle('active', match);
            panel.hidden = !match;
        });
    }

    calcTabs.forEach(btn => {
        btn.addEventListener('click', function() {
            const calcId = this.getAttribute('data-calc');
            window.location.hash = calcId;
            selectCalc(calcId);
        });
    });

    // Se tiver hash na URL ao carregar (ex: #pj-clt)
    if (window.location.hash) {
        const hash = window.location.hash.replace('#', '');
        const target = document.querySelector(`.calc-tab-btn[data-calc="${hash}"]`);
        if (target) selectCalc(hash);
    }

    // =====================================
    // 01. CÁLCULO CUSTO ABRIR CNPJ
    // =====================================
    function runCalcCnpj() {
        const uf = document.getElementById('cnpj-uf').value;
        const tipo = document.getElementById('cnpj-tipo').value;
        let junta = 198;
        let alvara = "Isento (SP)";

        if (uf === 'RJ') { junta = 285; alvara = "R$ 150,00"; }
        else if (uf === 'MG') { junta = 210; alvara = "R$ 90,00"; }
        else if (uf === 'PR') { junta = 160; alvara = "R$ 110,00"; }
        else if (uf === 'OUTRO') { junta = 220; alvara = "Variável"; }

        if (tipo === 'LTDA') junta += 80;

        document.getElementById('res-cnpj-junta').textContent = 'R$ ' + junta.toFixed(2).replace('.', ',');
        document.getElementById('res-cnpj-alvara').textContent = alvara;
        document.getElementById('res-cnpj-economia').textContent = 'R$ 1.200,00';
    }
    document.getElementById('btn-calc-cnpj')?.addEventListener('click', runCalcCnpj);
    document.getElementById('cnpj-uf')?.addEventListener('change', runCalcCnpj);
    document.getElementById('cnpj-tipo')?.addEventListener('change', runCalcCnpj);

    // =====================================
    // 02. CÁLCULO PJ x CLT
    // =====================================
    function runCalcCltPj() {
        const brutoClt = parseFloat(document.getElementById('clt-bruto').value) || 8000;
        const beneficios = parseFloat(document.getElementById('clt-beneficios').value) || 1200;
        const faturamentoPj = parseFloat(document.getElementById('pj-faturamento').value) || (brutoClt * 1.5);

        // Desconto INSS CLT aproximado (teto 2026/2025 ~ R$ 908)
        let inssClt = Math.min(brutoClt * 0.11, 908);
        let baseIr = brutoClt - inssClt;
        let irpfClt = 0;
        if (baseIr > 4664) irpfClt = baseIr * 0.275 - 896;
        else if (baseIr > 3751) irpfClt = baseIr * 0.225 - 662;
        else if (baseIr > 2826) irpfClt = baseIr * 0.15 - 381;
        else if (baseIr > 2259) irpfClt = baseIr * 0.075 - 169;
        irpfClt = Math.max(0, irpfClt);

        let liquidoClt = brutoClt - inssClt - irpfClt + beneficios;
        let anualClt = (liquidoClt * 12) + (brutoClt - inssClt - irpfClt) + ((brutoClt / 3) * 0.725) + (brutoClt * 0.08 * 12);

        // Como PJ na Cotech (Simples Nacional Anexo III 6%)
        let impostoSimples = faturamentoPj * 0.06;
        let proLabore = Math.max(1518, faturamentoPj * 0.28);
        let inssPj = proLabore * 0.11;
        let liquidoPj = faturamentoPj - impostoSimples - inssPj;
        let anualPj = liquidoPj * 12;
        let diferenca = anualPj - anualClt;

        const fmt = val => 'R$ ' + Math.round(val).toLocaleString('pt-BR');

        document.getElementById('res-clt-liquido').textContent = fmt(liquidoClt);
        document.getElementById('res-clt-inss').textContent = '- ' + fmt(inssClt);
        document.getElementById('res-clt-irpf').textContent = '- ' + fmt(irpfClt);
        document.getElementById('res-clt-anual').textContent = fmt(anualClt);

        document.getElementById('res-pj-liquido').textContent = fmt(liquidoPj);
        document.getElementById('res-pj-imposto').textContent = '- ' + fmt(impostoSimples);
        document.getElementById('res-pj-inss').textContent = '- ' + fmt(inssPj);
        document.getElementById('res-pj-anual').textContent = fmt(anualPj);
        document.getElementById('res-pj-diferenca').textContent = (diferenca > 0 ? '+ ' : '') + fmt(diferenca) + ' / ano';
    }
    document.getElementById('btn-calc-clt-pj')?.addEventListener('click', runCalcCltPj);
    document.getElementById('clt-bruto')?.addEventListener('input', runCalcCltPj);
    document.getElementById('clt-beneficios')?.addEventListener('input', runCalcCltPj);
    document.getElementById('pj-faturamento')?.addEventListener('input', runCalcCltPj);

    // =====================================
    // 03. CÁLCULO FATOR R
    // =====================================
    function runCalcFator() {
        const fat = parseFloat(document.getElementById('fator-faturamento').value) || 20000;
        const folha = parseFloat(document.getElementById('fator-folha').value) || 6000;
        const ratio = (folha / fat) * 100;

        document.getElementById('res-fator-percent').textContent = ratio.toFixed(1).replace('.', ',') + '%';

        const fmt = val => 'R$ ' + Math.round(val).toLocaleString('pt-BR');
        const badge = document.getElementById('res-fator-badge');
        const advice = document.getElementById('res-fator-advice');

        if (ratio >= 28) {
            badge.textContent = "ANEXO III - 6% DE IMPOSTO";
            badge.style.background = "#10b981";
            let imposto = fat * 0.06;
            let anexo5 = fat * 0.155;
            document.getElementById('res-fator-aliquota').textContent = "6,0% (Anexo III)";
            document.getElementById('res-fator-imposto').textContent = fmt(imposto);
            document.getElementById('res-fator-anexo5').textContent = fmt(anexo5);
            document.getElementById('res-fator-economia').textContent = fmt(anexo5 - imposto) + ' / mês';
            advice.innerHTML = "<p>✓ <strong>Excelente!</strong> Seu Fator R está igual ou superior a 28%. A Cotech garante a apuração correta para você recolher apenas 6% de imposto.</p>";
        } else {
            badge.textContent = "ATENÇÃO: ANEXO V - 15,5% DE IMPOSTO";
            badge.style.background = "#ef4444";
            let imposto = fat * 0.155;
            let metaFolha = fat * 0.28;
            document.getElementById('res-fator-aliquota').textContent = "15,5% (Anexo V)";
            document.getElementById('res-fator-imposto').textContent = fmt(imposto);
            document.getElementById('res-fator-anexo5').textContent = fmt(imposto);
            document.getElementById('res-fator-economia').textContent = 'R$ 0,00';
            advice.innerHTML = `<p>⚠️ <strong>Alerta de economia:</strong> Seu Fator R é inferior a 28%. A Cotech recomenda ajustar seu pró-labore para <strong>${fmt(metaFolha)}</strong>. Isso reduz seu imposto para 6%, economizando <strong>${fmt((fat * 0.155) - (fat * 0.06))}</strong> todo mês!</p>`;
        }
    }
    document.getElementById('btn-calc-fator')?.addEventListener('click', runCalcFator);
    document.getElementById('fator-faturamento')?.addEventListener('input', runCalcFator);
    document.getElementById('fator-folha')?.addEventListener('input', runCalcFator);

    // =====================================
    // 04. CÁLCULO RPA
    // =====================================
    function runCalcRpa() {
        const bruto = parseFloat(document.getElementById('rpa-bruto').value) || 7000;
        const dep = parseInt(document.getElementById('rpa-dependentes').value) || 0;
        const issTax = parseFloat(document.getElementById('rpa-iss').value) || 0.05;

        let inss = Math.min(bruto * 0.11, 908);
        let baseIr = bruto - inss - (dep * 189.59);
        let ir = 0;
        if (baseIr > 4664) ir = baseIr * 0.275 - 896;
        else if (baseIr > 3751) ir = baseIr * 0.225 - 662;
        else if (baseIr > 2826) ir = baseIr * 0.15 - 381;
        else if (baseIr > 2259) ir = baseIr * 0.075 - 169;
        ir = Math.max(0, ir);

        let iss = bruto * issTax;
        let liquido = bruto - inss - ir - iss;
        let pjImposto = bruto * 0.06;
        let economia = (inss + ir + iss) - pjImposto;

        const fmt = val => 'R$ ' + Math.round(val).toLocaleString('pt-BR');

        document.getElementById('res-rpa-liquido').textContent = fmt(liquido);
        document.getElementById('res-rpa-inss').textContent = '- ' + fmt(inss);
        document.getElementById('res-rpa-irrf').textContent = '- ' + fmt(ir);
        document.getElementById('res-rpa-iss').textContent = '- ' + fmt(iss);
        document.getElementById('res-rpa-pj').textContent = fmt(pjImposto) + ' (6% PJ)';
        document.getElementById('res-rpa-economia').textContent = fmt(economia);
    }
    document.getElementById('btn-calc-rpa')?.addEventListener('click', runCalcRpa);
    document.getElementById('rpa-bruto')?.addEventListener('input', runCalcRpa);
    document.getElementById('rpa-dependentes')?.addEventListener('input', runCalcRpa);
    document.getElementById('rpa-iss')?.addEventListener('change', runCalcRpa);

    // =====================================
    // 05. CÁLCULO REFORMA TRIBUTÁRIA
    // =====================================
    function runCalcReforma() {
        const regime = document.getElementById('ref-regime').value;
        const modelo = document.getElementById('ref-modelo').value;
        const statusEl = document.getElementById('res-ref-status');
        const summaryEl = document.getElementById('res-ref-summary');
        const recEl = document.getElementById('res-ref-recomendado');

        if (regime === 'simples' && modelo === 'b2b') {
            statusEl.textContent = "Vantagem Competitiva B2B";
            summaryEl.textContent = "Sua empresa no Simples Nacional continuará simplificada e poderá transferir créditos fiscais de IBS/CBS às empresas contratantes.";
            recEl.textContent = "Simples Nacional com Aproveitamento B2B";
        } else if (regime === 'presumido') {
            statusEl.textContent = "Planejamento Crucial";
            summaryEl.textContent = "No Lucro Presumido a unificação do PIS/COFINS em CBS exigirá revisão minuciosa da margem e dos custos tributários para manter a lucratividade.";
            recEl.textContent = "Transição Guiada pela Cotech";
        } else {
            statusEl.textContent = "Estabilidade Tributária";
            summaryEl.textContent = "Para o consumidor final (B2C), o Simples Nacional permanece como a alternativa mais econômica e desburocratizada do país.";
            recEl.textContent = "Simples Nacional Convencional";
        }
    }
    document.getElementById('btn-calc-reforma')?.addEventListener('click', runCalcReforma);
    document.getElementById('ref-regime')?.addEventListener('change', runCalcReforma);
    document.getElementById('ref-modelo')?.addEventListener('change', runCalcReforma);

    // Iniciar cálculos iniciais
    runCalcCnpj();
    runCalcCltPj();
    runCalcFator();
    runCalcRpa();
    runCalcReforma();
});
</script>
@endsection
