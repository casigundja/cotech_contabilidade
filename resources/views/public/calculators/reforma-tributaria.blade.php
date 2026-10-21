@extends('layouts.public')
@section('title', 'Calculadora da Reforma Tributária | Simule os Impactos nos seus Impostos | Cotech')
@section('description', 'Simule os impactos da Reforma Tributária nos seus impostos. Use a calculadora da Cotech para comparar valores, avaliar cenários e se planejar com antecedência para as novas regras.')

@section('content')
<div class="crt-page">
    <!-- BREADCRUMB -->
    <div class="cbr-breadcrumb-bar">
        <div class="container">
            <nav class="cbr-breadcrumb" aria-label="Navegação estrutural">
                <a href="/">Materiais</a>
                <span class="sep">></span>
                <span class="current">Calculadora</span>
            </nav>
        </div>
    </div>

    <!-- 01. HERO BANNER (PRINT 1 TOP) -->
    <section class="crt-hero-banner-section">
        <div class="crt-hero-banner">
            <div class="crt-hero-content">
                <h1>Simule os impactos da Reforma Tributária nos seus impostos<span class="dot-cyan">.</span></h1>
                <p>Use a calculadora da Cotech para comparar valores, avaliar cenários e se planejar com antecedência para as novas regras.</p>
            </div>
            <div class="crt-hero-img-wrap">
                <img src="/images/reforma-charles-gularte.jpg" alt="Charles Gularte - Contador Cotech" class="crt-hero-img" width="380" height="270">
                <div class="crt-hero-badge">
                    <strong>Charles Gularte</strong>
                    <span>Contador responsável e técnico</span>
                    <small>CRC PR-045113/O-7</small>
                </div>
            </div>
        </div>
    </section>

    <!-- 02. FORM SECTION (PRINT 1 FORM) -->
    <section class="crt-form-section" id="simulador">
        <div class="container">
            <h2 class="crt-form-title">Para começar, informe seus dados profissionais<span class="dot-cyan">.</span></h2>

            <div class="crt-form-grid">
                <!-- COL 1 -->
                <div>
                    <!-- FIELD 1 -->
                    <div class="crt-group">
                        <label for="crt-empresa-aberta" class="crt-label">Você tem empresa aberta?</label>
                        <select id="crt-empresa-aberta" class="crt-select">
                            <option value="" disabled>Selecione uma das opções</option>
                            <option value="sim" selected>Sim, já tenho empresa ativa</option>
                            <option value="nao">Não, ainda não tenho empresa</option>
                        </select>
                    </div>

                    <!-- FIELD 2 -->
                    <div class="crt-group">
                        <label for="crt-regime" class="crt-label">Qual é seu regime tributário?</label>
                        <select id="crt-regime" class="crt-select">
                            <option value="" disabled>Selecione uma das opções</option>
                            <option value="simples" selected>Simples Nacional</option>
                            <option value="presumido">Lucro Presumido</option>
                            <option value="real">Lucro Real</option>
                            <option value="indefinido">Ainda não sei meu regime</option>
                        </select>
                    </div>

                    <!-- FIELD 3 -->
                    <div class="crt-group">
                        <label for="crt-socios" class="crt-label">Possui sócios além de você?</label>
                        <select id="crt-socios" class="crt-select">
                            <option value="" disabled>Selecione a quantidade de sócios</option>
                            <option value="0" selected>Não possuo sócios (Individual / SLU)</option>
                            <option value="1">1 sócio</option>
                            <option value="2">2 sócios</option>
                            <option value="3+">3 ou mais sócios</option>
                        </select>
                    </div>

                    <!-- FIELD 4 -->
                    <div class="crt-group">
                        <label for="crt-despesas" class="crt-label">
                            Além de impostos e folha salarial, quanto em média você gasta por mês com despesas profissionais?
                        </label>
                        <input type="text" id="crt-despesas" class="crt-input" placeholder="R$ 0,00" value="R$ 3.000,00">
                    </div>
                </div>

                <!-- COL 2 -->
                <div>
                    <!-- FIELD 5 -->
                    <div class="crt-group">
                        <label for="crt-atividade" class="crt-label">Qual atividade você exerce?</label>
                        <select id="crt-atividade" class="crt-select">
                            <option value="" disabled>Selecione a atividade</option>
                            <option value="ti" selected>Desenvolvimento de Software, TI e Tecnologia</option>
                            <option value="consultoria">Consultoria Empresarial e Gestão Financeira</option>
                            <option value="saude">Serviços Médicos, Odontologia e Saúde</option>
                            <option value="juridico">Serviços Jurídicos e Advocacia</option>
                            <option value="engenharia">Engenharia, Arquitetura e Urbanismo</option>
                            <option value="marketing">Marketing, Design, Publicidade e Criação</option>
                            <option value="comercio">Comércio e Vendas Online (E-commerce)</option>
                            <option value="outros">Outras atividades de prestação de serviços</option>
                        </select>
                    </div>

                    <!-- FIELD 6 -->
                    <div class="crt-group">
                        <label for="crt-faturamento" class="crt-label">Quanto sua empresa fatura, em média, por mês?</label>
                        <input type="text" id="crt-faturamento" class="crt-input" placeholder="R$ 0,00" value="R$ 25.000,00">
                    </div>

                    <!-- FIELD 7 -->
                    <div class="crt-group">
                        <label class="crt-label">Você presta serviços principalmente para:</label>
                        <div class="crt-radios">
                            <label class="crt-radio-label">
                                <input type="radio" name="crt_publico" value="pf"> Pessoas físicas
                            </label>
                            <label class="crt-radio-label">
                                <input type="radio" name="crt_publico" value="pj" checked> Empresas
                            </label>
                        </div>
                    </div>

                    <!-- FIELD 8 -->
                    <div class="crt-group">
                        <label class="crt-label">
                            Você presta serviços para clientes de fora do Brasil?
                            <span class="tip" title="Exportação de serviços possui alíquota zero no novo sistema (imunidade constitucional do IBS e CBS)">ⓘ</span>
                        </label>
                        <div class="crt-radios">
                            <label class="crt-radio-label">
                                <input type="radio" name="crt_exterior" value="sim"> Sim
                            </label>
                            <label class="crt-radio-label">
                                <input type="radio" name="crt_exterior" value="nao" checked> Não
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <button type="button" id="crt-btn-calc" class="crt-btn-simular">Simule meus impostos</button>
            </div>

            <p class="crt-legal-note">
                Ao utilizar esta ferramenta, você declara estar ciente de que os valores apresentados são apenas estimativas e concorda com a nossa <a href="/pagina/privacidade">Política de Privacidade</a>, Política de Cookies e <a href="/pagina/privacidade">Termos de Uso</a>. Para saber mais sobre os critérios utilizados nos cálculos, <a href="#como-usar">clique aqui</a>.
            </p>

            <!-- RESULTS PANEL -->
            <div id="crt-results-card" class="crt-results-card">
                <div class="crt-results-head">
                    <div>
                        <h3>Diagnóstico Comparativo de Impacto Tributário</h3>
                        <small style="color: #64748b;">Simulação baseada na Emenda Constitucional nº 132/2023 e regras de transição</small>
                    </div>
                </div>

                <div class="crt-results-grid">
                    <!-- SCENARIO 1: ATUAL -->
                    <div class="crt-res-box">
                        <div class="crt-res-title">Regime Atual (Simples Nacional / Fator R):</div>
                        <div class="crt-res-value" id="res-crt-atual-val">R$ 1.500,00 /mês</div>
                        <ul class="crt-res-list">
                            <li><span>Faturamento Bruto:</span> <strong id="res-crt-faturamento">R$ 25.000,00</strong></li>
                            <li><span>Alíquota Efetiva Atual:</span> <strong id="res-crt-aliquota-atual">6,0% (Anexo III)</strong></li>
                            <li><span>Crédito Tributário Atual:</span> <strong>R$ 0,00 (Sem crédito pleno)</strong></li>
                            <li style="border-top: 1px dashed #cbd5e1; padding-top: 6px;">
                                <span>Total Anual em Impostos:</span>
                                <strong id="res-crt-atual-anual">R$ 18.000,00</strong>
                            </li>
                        </ul>
                    </div>

                    <!-- SCENARIO 2: REFORMA -->
                    <div class="crt-res-box highlight">
                        <div class="crt-res-title">Cenário Reforma Tributária (IVA Dual):</div>
                        <div class="crt-res-value" style="color: #004b87;" id="res-crt-reforma-val">R$ 1.625,00 /mês</div>
                        <ul class="crt-res-list">
                            <li><span>Alíquota Projetada (CBS + IBS):</span> <strong id="res-crt-reforma-aliq">6,5% a 8,5%</strong></li>
                            <li><span>Crédito sobre Despesas (Insumos):</span> <strong id="res-crt-credito" style="color: #059669;">- R$ 390,00 /mês</strong></li>
                            <li><span>Direito a Crédito pelo seu Cliente PJ:</span> <strong style="color: #059669;">SIM (100% repassável)</strong></li>
                            <li style="border-top: 1px dashed #93c5fd; padding-top: 6px;">
                                <span>Impacto Estimado na Sua Margem:</span>
                                <strong id="res-crt-impacto" style="color: #059669;">Impacto Neutro / Vantajoso</strong>
                            </li>
                        </ul>
                    </div>
                </div>

                <div style="background: #e0f2fe; border-radius: 8px; padding: 14px 18px; margin-bottom: 20px; font-size: 14px; color: #0369a1;">
                    🎯 <strong>Orientação Estratégica Cotech:</strong> A Reforma Tributária mantém a opção de permanência no Simples Nacional e permite que empresas do setor de serviços aproveitem regimes híbridos de crédito. Nossa equipe já tem os modelos prontos para blindar seu negócio.
                </div>

                <div style="text-align: center;">
                    <a id="crt-cta-link" href="/orcamento?servico=reforma-tributaria" class="cbr-btn-cyan">Falar com Contador Especialista e Planejar Minha Empresa ↗</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 03. CONSULTANT SUPPORT SECTION (PRINT 2 TOP) -->
    <section class="crt-support-section">
        <div class="container">
            <div class="crt-support-grid">
                <div class="crt-support-content">
                    <h2>Tire dúvidas sobre a Reforma Tributária com um contador gratuitamente<span class="dot-cyan">.</span></h2>
                    
                    <ul class="crt-support-checklist">
                        <li><span class="chk">✓</span> <span>Entenda quanto imposto sua empresa pode pagar com as novas regras</span></li>
                        <li><span class="chk">✓</span> <span>Saiba se você vai pagar mais, menos ou parecido com hoje</span></li>
                        <li><span class="chk">✓</span> <span>Esclareça questões sobre nota fiscal e regularização.</span></li>
                        <li><span class="chk">✓</span> <span>Receba orientações claras sobre o que fazer agora</span></li>
                    </ul>

                    <a href="/orcamento?servico=reforma-tributaria" class="crt-support-btn">Fale grátis com um contador</a>
                </div>

                <div class="crt-support-img-wrap">
                    <img src="/images/reforma-thaina-perzibila.jpg" alt="Thaina Perzibila - Contadora Cotech" class="crt-support-img" width="460" height="340">
                    <div class="crt-support-badge">
                        <strong>Thaina Perzibila</strong>
                        <span>Contadora Cotech</span>
                        <small>CRC PR-084555/O</small>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- 05. TABS SECTION (PRINT 3) -->
    <section class="crt-tabs-section" id="como-usar">
        <div class="container">
            <div class="crt-tabs-header">
                <h2>Como usar a Calculadora da Reforma Tributária?</h2>
                <p>Entenda como funciona o cálculo e o que vai mudar para as empresas na Reforma Tributária.</p>
            </div>

            <div class="crt-tabs-layout">
                <!-- TABS NAV -->
                <div class="crt-tabs-nav" role="tablist">
                    <button type="button" class="crt-tab-item active" data-tab="tab-como-usar">Como usar</button>
                    <button type="button" class="crt-tab-item" data-tab="tab-como-funciona">Como funciona o cálculo</button>
                    <button type="button" class="crt-tab-item" data-tab="tab-diferencial">Qual o diferencial da calculadora</button>
                    <button type="button" class="crt-tab-item" data-tab="tab-o-que-muda">O que vai mudar com a Reforma Tributária</button>
                    <button type="button" class="crt-tab-item" data-tab="tab-como-calcular">Como calcular os novos impostos</button>
                    <button type="button" class="crt-tab-item" data-tab="tab-como-preparar">Como se preparar para a Reforma Tributária</button>
                </div>

                <!-- TABS CONTENT PANES -->
                <div>
                    <!-- TAB 1: COMO USAR -->
                    <div id="tab-como-usar" class="crt-tab-content-pane active">
                        <h3>Como usar</h3>
                        <p>Para usar a calculadora da Reforma Tributária, selecione a atividade exercida pela empresa e preencha algumas informações, como regime tributário e faturamento bruto mensal.</p>
                        <p>Com esses dados, o simulador aplica o fator R automaticamente (quando aplicável), identifica o anexo correto no Simples Nacional e gera os cenários comparativos.</p>
                        <p>A calculadora apresenta a tributação no regime atual (Simples Nacional ou Lucro Presumido) e compara com os novos regimes previstos para 2027 e 2028.</p>
                        <a href="#simulador" class="crt-tab-btn-calc">Quero calcular</a>
                    </div>

                    <!-- TAB 2: COMO FUNCIONA O CÁLCULO -->
                    <div id="tab-como-funciona" class="crt-tab-content-pane">
                        <h3>Como funciona o cálculo</h3>
                        <p>O cálculo compara o somatório dos tributos extintos (PIS, COFINS, ISS e ICMS) com o novo modelo do IVA Dual (CBS federal e IBS estadual/municipal).</p>
                        <p>Durante o período de transição gradual (iniciado com alíquotas de teste de 0,9% para CBS e 0,1% para IBS em 2026), as empresas poderão optar entre manter o regime simplificado ou transferir créditos integrais para clientes PJ.</p>
                        <p>A Cotech projeta a alíquota de equilíbrio considerando as compras de insumos e despesas profissionais informadas.</p>
                        <a href="#simulador" class="crt-tab-btn-calc">Quero calcular</a>
                    </div>

                    <!-- TAB 3: QUAL O DIFERENCIAL -->
                    <div id="tab-diferencial" class="crt-tab-content-pane">
                        <h3>Qual o diferencial da calculadora</h3>
                        <p>Diferente de simulações genéricas, a calculadora da Cotech considera as particularidades do setor de serviços intelectuais, como o redutor de 30% na alíquota do IVA para profissões regulamentadas (medicina, advocacia, engenharia, etc.).</p>
                        <p>Além disso, apuramos o crédito tributário gerado pelas despesas do negócio, revelando o impacto real no caixa da sua empresa.</p>
                        <a href="#simulador" class="crt-tab-btn-calc">Quero calcular</a>
                    </div>

                    <!-- TAB 4: O QUE VAI MUDAR -->
                    <div id="tab-o-que-muda" class="crt-tab-content-pane">
                        <h3>O que vai mudar com a Reforma Tributária</h3>
                        <p>A principal mudança é o fim da cumulatividade tributária e a substituição de 5 tributos complexos por dois: a Contribuição sobre Bens e Serviços (CBS) da União e o Imposto sobre Bens e Serviços (IBS) de Estados e Municípios.</p>
                        <p>Para prestadores de serviços, o Simples Nacional continuará existindo, com a opção vantajosa de segregar a CBS/IBS para gerar créditos aos seus contratantes corporativos.</p>
                        <a href="#simulador" class="crt-tab-btn-calc">Quero calcular</a>
                    </div>

                    <!-- TAB 5: COMO CALCULAR OS NOVOS IMPOSTOS -->
                    <div id="tab-como-calcular" class="crt-tab-content-pane">
                        <h3>Como calcular os novos impostos</h3>
                        <p>No novo modelo, o tributo devido é apurado pelo método débito menos crédito: multiplica-se a receita pela alíquota de referência e subtrai-se o imposto pago em todas as compras e serviços contratados pela empresa.</p>
                        <p>Empresas exportadoras de serviços contam com alíquota zero (isenção completa) e ressarcimento rápido dos créditos acumulados.</p>
                        <a href="#simulador" class="crt-tab-btn-calc">Quero calcular</a>
                    </div>

                    <!-- TAB 6: COMO SE PREPARAR -->
                    <div id="tab-como-preparar" class="crt-tab-content-pane">
                        <h3>Como se preparar para a Reforma Tributária</h3>
                        <p>A preparação começa com a organização das notas fiscais e compras da empresa, garantindo que 100% das despesas gerem créditos fiscais válidos.</p>
                        <p>Nossos contadores realizam o planejamento tributário preventivo para que sua empresa aproveite todas as regras de transição sem aumento de carga tributária.</p>
                        <a href="/orcamento?servico=reforma-tributaria" class="crt-tab-btn-calc">Falar com a Cotech ↗</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inFaturamento = document.getElementById('crt-faturamento');
    const inDespesas = document.getElementById('crt-despesas');
    const selEmpresa = document.getElementById('crt-empresa-aberta');
    const selRegime = document.getElementById('crt-regime');
    const selSocios = document.getElementById('crt-socios');
    const selAtividade = document.getElementById('crt-atividade');
    const btnCalc = document.getElementById('crt-btn-calc');
    const resultsCard = document.getElementById('crt-results-card');

    function parseMoney(val) {
        if (!val) return 0;
        const clean = String(val).replace(/[^\d]/g, '');
        return (parseFloat(clean) || 0) / 100;
    }

    function fmt(val) {
        return val.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    function setupMoneyInput(el) {
        if (!el) return;
        el.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (!value) value = '0';
            const num = parseFloat(value) / 100;
            e.target.value = num.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        });
    }

    [inFaturamento, inDespesas].forEach(setupMoneyInput);

    function calcular() {
        const fat = parseMoney(inFaturamento.value) || 25000;
        const desp = parseMoney(inDespesas.value) || 3000;
        const regime = selRegime.value;

        // Alíquota atual estimada
        let aliqAtual = 0.06;
        let regimeNome = 'Simples Nacional (6%)';
        if (regime === 'presumido') {
            aliqAtual = 0.1633;
            regimeNome = 'Lucro Presumido (~16,3%)';
        } else if (regime === 'real') {
            aliqAtual = 0.18;
            regimeNome = 'Lucro Real (~18%)';
        }

        const impostoAtual = fat * aliqAtual;
        const impostoAtualAnual = impostoAtual * 12;

        // Projeção Reforma Tributária: alíquota setor serviços com benefício Simples ou IVA Dual com crédito
        // Crédito sobre despesas (IVA padrão de aprox. 26.5% no insumo): desp * 0.265
        const creditoInsumos = desp * 0.265;
        // Alíquota projetada no regime híbrido / Simples mantido: entre 6.5% e 8.5%
        const aliqProjetada = regime === 'presumido' ? 0.14 : 0.07;
        const impostoReformaBruto = fat * aliqProjetada;
        const impostoReformaLiquido = Math.max(impostoReformaBruto - (regime === 'presumido' ? creditoInsumos : 0), fat * 0.06);

        document.getElementById('res-crt-faturamento').textContent = fmt(fat);
        document.getElementById('res-crt-aliquota-atual').textContent = (aliqAtual * 100).toFixed(1).replace('.', ',') + '% (' + regimeNome + ')';
        document.getElementById('res-crt-atual-val').textContent = fmt(impostoAtual) + ' /mês';
        document.getElementById('res-crt-atual-anual').textContent = fmt(impostoAtualAnual) + ' /ano';

        document.getElementById('res-crt-reforma-val').textContent = fmt(impostoReformaLiquido) + ' /mês';
        document.getElementById('res-crt-reforma-aliq').textContent = (aliqProjetada * 100).toFixed(1).replace('.', ',') + '% (com incentivo setor)';
        document.getElementById('res-crt-credito').textContent = '- ' + fmt(creditoInsumos) + ' /mês';

        const diff = impostoReformaLiquido - impostoAtual;
        const impactoEl = document.getElementById('res-crt-impacto');
        if (diff <= 50) {
            impactoEl.textContent = 'Neutro / Vantajoso com a Cotech';
            impactoEl.style.color = '#059669';
        } else {
            impactoEl.textContent = 'Variação de +' + fmt(diff) + ' /mês (Otimizável)';
            impactoEl.style.color = '#d97706';
        }

        const ctaLink = document.getElementById('crt-cta-link');
        if (ctaLink) {
            ctaLink.href = `/orcamento?servico=reforma-tributaria&faturamento=${encodeURIComponent(fat)}&regime=${encodeURIComponent(regime)}`;
        }

        resultsCard.classList.add('show');
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    btnCalc?.addEventListener('click', calcular);

    // TABS SWITCHER
    const tabBtns = document.querySelectorAll('.crt-tab-item');
    const tabPanes = document.querySelectorAll('.crt-tab-content-pane');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-tab');
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));

            this.classList.add('active');
            const target = document.getElementById(targetId);
            if (target) target.classList.add('active');
        });
    });
});
</script>
@endsection
