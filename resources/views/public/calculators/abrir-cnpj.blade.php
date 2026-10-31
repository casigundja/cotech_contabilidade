@extends('layouts.public')
@section('title', 'Calculadora Custo para tirar CNPJ | Cotech Contabilidade')
@section('description', 'Preencha as informações e descubra quanto custa para abrir um CNPJ no Brasil com a nossa calculadora gratuita. Abra sua empresa com honorários grátis na Cotech.')

@section('content')
<div class="cbr-page">
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

    <!-- HERO SECTION & CALCULATOR -->
    <div class="cbr-hero-section">
        <div class="cbr-hero-container">
            <h1 class="cbr-main-title">Calculadora Custo para tirar CNPJ<span class="dot-cyan">.</span></h1>
            <p class="cbr-lead-p">Os custos para abrir uma empresa variam de acordo com a região e o tipo de negócio. Em geral, incluem taxas da Junta Comercial, emissão do Certificado Digital, além de licenças e alvarás da prefeitura.</p>
            <p class="cbr-lead-p">Preencha as informações abaixo e descubra quanto custa para abrir um CNPJ no Brasil com a nossa calculadora gratuita.</p>
        </div>

        <!-- CALCULATOR TWO COLUMNS -->
        <div class="cbr-calc-wrapper">
            <!-- LEFT: CONSULTANT WITH DUAL-CIRCLE DESIGN AND PILL BADGES (PRINT 1 REPLICA WITH PRINT 3 IMAGE) -->
            <div class="cbr-consultant-col">
                <div class="cbr-consultant-frame">
                    <div class="cbr-avatar-bg-circle" aria-hidden="true"></div>
                    <div class="cbr-avatar-mask">
                        <img src="/images/cotech-socios.png" alt="Francisco Calombe - Contador Consultor Cotech" width="320" height="320">
                    </div>
                    <div class="cbr-consultant-badges">
                        <div class="cbr-badge-pill-name">Francisco Calombe</div>
                        <div class="cbr-badge-pill-role">
                            <span class="role-title">Contador Consultor</span>
                            <span class="role-crc">CRC/SP 305427/O-2</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: FORM -->
            <div class="cbr-form-col">
                <div class="cbr-form-group">
                    <label for="cbr-cidade" class="cbr-form-label">Em qual cidade você pretende abrir sua empresa?</label>
                    <select id="cbr-cidade" class="cbr-select">
                        <option value="SP" selected>São Paulo - SP</option>
                        <option value="RJ">Rio de Janeiro - RJ</option>
                        <option value="MG">Belo Horizonte - MG</option>
                        <option value="PR">Curitiba - PR</option>
                        <option value="RS">Porto Alegre - RS</option>
                        <option value="SC">Florianópolis - SC</option>
                        <option value="BA">Salvador - BA</option>
                        <option value="PE">Recife - PE</option>
                        <option value="CE">Fortaleza - CE</option>
                        <option value="DF">Brasília - DF</option>
                        <option value="GO">Goiânia - GO</option>
                        <option value="OUTRO">Outra Cidade / Estado</option>
                    </select>
                </div>

                <div class="cbr-form-group">
                    <label for="cbr-atividade" class="cbr-form-label">Qual atividade você exerce ou exercerá?</label>
                    <select id="cbr-atividade" class="cbr-select">
                        <option value="servico" selected>Selecione uma atividade</option>
                        <option value="ti">Tecnologia, TI e Desenvolvimento de Software</option>
                        <option value="consultoria">Consultoria, Marketing e Gestão</option>
                        <option value="saude">Saúde, Médicos e Psicologia</option>
                        <option value="engenharia">Engenharia, Arquitetura e Projetos</option>
                        <option value="comercio">Comércio e Venda de Produtos</option>
                        <option value="outros">Outros Serviços</option>
                    </select>
                </div>

                <div class="cbr-form-group">
                    <label for="cbr-faturamento" class="cbr-form-label">
                        Quanto você prevê que sua empresa faturará mensalmente?
                        <span class="info-tip" title="O faturamento estimado define o enquadramento tributário mais vantajoso">ⓘ</span>
                    </label>
                    <input type="text" id="cbr-faturamento" class="cbr-input" value="R$ 15.000,00" placeholder="R$ 0,00">
                </div>

                <!-- CAPTCHA WIDGET -->
                <div class="cbr-recaptcha-box">
                    <label class="cbr-recaptcha-left" for="cbr-captcha-check">
                        <input type="checkbox" id="cbr-captcha-check" class="cbr-recaptcha-check" checked>
                        <span class="cbr-recaptcha-text">Não sou um robô</span>
                    </label>
                    <div class="cbr-recaptcha-brand">
                        <svg viewBox="0 0 48 48" fill="none"><path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4Z" fill="#1A73E8"/><path d="M24 10v6a8 8 0 0 1 8 8h6a14 14 0 0 0-14-14Z" fill="#fff"/></svg>
                        <span>reCAPTCHA</span>
                        <span><a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privacidade</a> - <a href="https://policies.google.com/terms" target="_blank" rel="noopener">Termos</a></span>
                    </div>
                </div>

                <button type="button" id="cbr-btn-calc" class="cbr-btn-cyan cbr-btn-full">Calcule o custo</button>

                <!-- DYNAMIC RESULTS BOX -->
                <div id="cbr-result-card" class="cbr-results-card">
                    <div class="cbr-results-header">
                        <h4>Estimativa de Custos para Abrir sua Empresa</h4>
                        <small id="cbr-res-city-text">Registro em São Paulo - SP</small>
                    </div>
                    <div class="cbr-res-list">
                        <div class="cbr-res-item">
                            <span>Taxa da Junta Comercial estadual:</span>
                            <strong id="cbr-res-junta">R$ 202,00</strong>
                        </div>
                        <div class="cbr-res-item">
                            <span>Taxa de Alvará / Prefeitura:</span>
                            <strong id="cbr-res-alvara">R$ 0,00 (Isento)</strong>
                        </div>
                        <div class="cbr-res-item">
                            <span>Certificado Digital e-CNPJ A1:</span>
                            <strong id="cbr-res-cert">R$ 179,00</strong>
                        </div>
                        <div class="cbr-res-item highlight-free">
                            <span>Honorários Contábeis Cotech:</span>
                            <strong>R$ 0,00 (100% GRÁTIS)</strong>
                        </div>
                        <div class="cbr-res-item highlight-total">
                            <span>Total de Taxas Governamentais:</span>
                            <strong id="cbr-res-total">R$ 381,00</strong>
                        </div>
                    </div>
                    <div class="cbr-res-saving">
                        <span>Sua economia abrindo com a Cotech:</span>
                        <strong id="cbr-res-saving">R$ 1.500,00</strong>
                    </div>
                    <a id="cbr-cta-link" href="/orcamento?servico=abrir-cnpj" class="cbr-btn-cyan cbr-btn-full">Abra sua empresa com a Cotech ↗</a>
                </div>
            </div>
        </div>

        <!-- DISCLAIMER -->
        <div class="cbr-disclaimer-wrapper">
            <p class="cbr-disclaimer-text">
                Ao utilizar esta ferramenta, você declara estar ciente de que os valores apresentados são apenas estimativas de acordo com as nossas <a href="/pagina/privacidade">Políticas de Privacidade</a>, Políticas de Cookies e Termos de Uso. Para saber mais sobre os critérios utilizados nos cálculos, <a href="#porque-abrir">clique aqui</a>.
            </p>
            <span class="cbr-disclaimer-date">Última atualização: 15/10/2026</span>
        </div>
    </div>

    <!-- SECTION: POR QUE ABRIR UM CNPJ? -->
    <section class="cbr-section-why" id="porque-abrir">
        <div class="container">
            <h2 class="cbr-section-title">Por que abrir um CNPJ?</h2>
            <div class="cbr-cards-grid">
                <div class="cbr-card">
                    <div class="cbr-card-icon">💰</div>
                    <h3>Imposto</h3>
                    <p>O imposto para pessoa física pode chegar até 27,5%. Como PJ, com o enquadramento fiscal e tributário correto, você paga bem menos do que isso.</p>
                </div>
                <div class="cbr-card">
                    <div class="cbr-card-icon">🩺</div>
                    <h3>Plano de saúde</h3>
                    <p>Você tem a possibilidade de contratar planos de saúde até 50% mais baratos em comparação aos ofertados para pessoa física.</p>
                </div>
                <div class="cbr-card">
                    <div class="cbr-card-icon">🏛️</div>
                    <h3>Crédito</h3>
                    <p>Com o seu CNPJ em mãos, você passa a ter acesso a condições bem mais vantajosas em linhas de crédito com bancos e fornecedores.</p>
                </div>
                <div class="cbr-card">
                    <div class="cbr-card-icon">🛡️</div>
                    <h3>Confiança</h3>
                    <p>Com a formalização da sua prestação de serviço você ganha a confiança dos seus clientes e aumenta suas chances de faturamento.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: ABRA SUA EMPRESA COM A COTECH -->
    <section class="cbr-section-steps">
        <div class="container">
            <h2 class="cbr-section-title">Abra sua empresa com a Cotech<span class="dot-cyan">.</span></h2>
            
            <div class="cbr-steps-wrapper">
                <div class="cbr-steps-line" aria-hidden="true"></div>
                
                <div class="cbr-step-item">
                    <div class="cbr-step-number">1</div>
                    <h4>Cadastro e contratação</h4>
                    <p>Você realiza o cadastro no site e contrata um de nossos planos.</p>
                </div>
                
                <div class="cbr-step-item">
                    <div class="cbr-step-number">2</div>
                    <h4>Envio da documentação</h4>
                    <p>Nossos especialistas receberão os seus documentos e cuidarão de tudo para você.</p>
                </div>
                
                <div class="cbr-step-item">
                    <div class="cbr-step-number">3</div>
                    <h4>CNPJ na mão</h4>
                    <p>Pague apenas os impostos obrigatórios de abertura e já tenha o seu CNPJ.</p>
                </div>
            </div>

            <div>
                <a href="/orcamento?servico=abrir-cnpj" class="cbr-btn-cyan">Abra sua empresa grátis</a>
            </div>
        </div>
    </section>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selCidade = document.getElementById('cbr-cidade');
    const selAtividade = document.getElementById('cbr-atividade');
    const inputFat = document.getElementById('cbr-faturamento');
    const btnCalc = document.getElementById('cbr-btn-calc');
    const resultCard = document.getElementById('cbr-result-card');
    const elJunta = document.getElementById('cbr-res-junta');
    const elAlvara = document.getElementById('cbr-res-alvara');
    const elCert = document.getElementById('cbr-res-cert');
    const elTotal = document.getElementById('cbr-res-total');
    const elSaving = document.getElementById('cbr-res-saving');
    const elCityText = document.getElementById('cbr-res-city-text');
    const ctaLink = document.getElementById('cbr-cta-link');

    const taxasPorUf = {
        'SP': { junta: 202.00, alvara: 0, nome: 'São Paulo - SP' },
        'RJ': { junta: 454.00, alvara: 180.00, nome: 'Rio de Janeiro - RJ' },
        'MG': { junta: 218.00, alvara: 0, nome: 'Belo Horizonte - MG' },
        'PR': { junta: 185.00, alvara: 0, nome: 'Curitiba - PR' },
        'RS': { junta: 220.00, alvara: 0, nome: 'Porto Alegre - RS' },
        'SC': { junta: 195.00, alvara: 0, nome: 'Florianópolis - SC' },
        'BA': { junta: 250.00, alvara: 120.00, nome: 'Salvador - BA' },
        'PE': { junta: 280.00, alvara: 0, nome: 'Recife - PE' },
        'CE': { junta: 240.00, alvara: 0, nome: 'Fortaleza - CE' },
        'DF': { junta: 170.00, alvara: 0, nome: 'Brasília - DF' },
        'GO': { junta: 290.00, alvara: 0, nome: 'Goiânia - GO' },
        'OUTRO': { junta: 250.00, alvara: 0, nome: 'Outros Estados' }
    };

    function fmt(val) {
        return val.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    function calcular() {
        const cidade = selCidade.value;
        const config = taxasPorUf[cidade] || taxasPorUf['SP'];
        const juntaVal = config.junta;
        const alvaraVal = config.alvara;
        const certVal = 179.00;
        const totalGov = juntaVal + alvaraVal + certVal;
        const economia = 1500.00;

        if (elCityText) elCityText.textContent = `Registro em ${config.nome}`;
        if (elJunta) elJunta.textContent = fmt(juntaVal);
        if (elAlvara) elAlvara.textContent = alvaraVal === 0 ? 'R$ 0,00 (Isento)' : fmt(alvaraVal);
        if (elCert) elCert.textContent = fmt(certVal);
        if (elTotal) elTotal.textContent = fmt(totalGov);
        if (elSaving) elSaving.textContent = fmt(economia);

        if (ctaLink) {
            ctaLink.href = `/orcamento?servico=abrir-cnpj&cidade=${encodeURIComponent(config.nome)}`;
        }

        if (resultCard) {
            resultCard.classList.add('show');
            resultCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    btnCalc?.addEventListener('click', calcular);
    selCidade?.addEventListener('change', function() {
        if (resultCard && resultCard.classList.contains('show')) {
            calcular();
        }
    });

    // Format currency input
    inputFat?.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (!value) value = '0';
        const num = parseFloat(value) / 100;
        e.target.value = num.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    });
});
</script>
@endsection
