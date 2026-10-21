@extends('layouts.public')
@section('title', 'Calculadora de RPA 2026 | Simule Impostos e Descontos de Autônomo | Cotech')
@section('description', 'Informe seus dados e receba o cálculo atualizado de impostos e descontos do RPA. Simule INSS, IRRF e ISS retidos na fonte e compare com o Simples Nacional.')

@section('content')
<div class="rpa-page">
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

    <!-- 01. HERO & FORM SECTION (PRINT 1) -->
    <div class="rpa-hero-section">
        <div class="container">
            <div class="rpa-header-wrap">
                <h1 class="rpa-title">Calculadora de RPA 2026<span class="dot-cyan">.</span></h1>
                <p class="rpa-subtitle">Informe seus dados e receba o cálculo atualizado de impostos e descontos do RPA.</p>
            </div>

            <div class="rpa-form-grid">
                <!-- CONSULTANT PROFILE (FERNANDO KIOSA) -->
                <div class="rpa-consultant-col">
                    <div class="rpa-avatar-wrap">
                        <div class="rpa-avatar-circle-bg" aria-hidden="true"></div>
                        <img src="/images/fernando-kiosa.jpg" alt="Fernando Kiosa - Contador Cotech" class="rpa-avatar-img" width="260" height="260">
                    </div>
                    <div class="rpa-badge-tag">
                        <strong>Fernando Kiosa</strong>
                        <span>Contador Cotech</span>
                        <small>CRC PR-077490/O-2</small>
                    </div>
                </div>

                <!-- FORM CARD -->
                <div class="rpa-form-card">
                    <!-- ROW 1 -->
                    <div class="rpa-row-2">
                        <div>
                            <label for="rpa-nome" class="rpa-field-label">Nome*</label>
                            <input type="text" id="rpa-nome" class="rpa-field-input" placeholder="Nome completo" value="Alexandre Silva">
                        </div>
                        <div>
                            <label for="rpa-bruto" class="rpa-field-label">Meu ganho bruto mensal:*</label>
                            <input type="text" id="rpa-bruto" class="rpa-field-input" placeholder="R$ 0,00" value="R$ 6.000,00">
                        </div>
                    </div>

                    <!-- ROW 2 -->
                    <div class="rpa-row-1">
                        <label for="rpa-atividade" class="rpa-field-label">Minha atividade:*</label>
                        <select id="rpa-atividade" class="rpa-field-select">
                            <option value="" disabled>Selecione a sua resposta</option>
                            <option value="ti" selected>Desenvolvimento de Software / TI / Dados</option>
                            <option value="consultoria">Consultoria e Gestão Empresarial</option>
                            <option value="saude">Saúde, Medicina e Odontologia</option>
                            <option value="psicologia">Psicologia e Terapias</option>
                            <option value="juridico">Serviços Jurídicos e Advocacia</option>
                            <option value="engenharia">Engenharia, Arquitetura e Projetos</option>
                            <option value="marketing">Marketing, Design e Criação</option>
                            <option value="outros">Outras atividades de prestação de serviços</option>
                        </select>
                    </div>

                    <!-- ROW 3 -->
                    <div class="rpa-row-2">
                        <div>
                            <label for="rpa-email" class="rpa-field-label">E-mail:*</label>
                            <input type="email" id="rpa-email" class="rpa-field-input" placeholder="Insira seu e-mail aqui" value="alexandre@exemplo.com.br">
                        </div>
                        <div>
                            <label for="rpa-telefone" class="rpa-field-label">Meu telefone:*</label>
                            <input type="tel" id="rpa-telefone" class="rpa-field-input" placeholder="(DD) 00000-0000" value="(11) 98765-4321">
                        </div>
                    </div>

                    <div class="rpa-legal-text">
                        <p style="margin: 0 0 6px;">Cálculo atualizado em 2026.</p>
                        <p style="margin: 0;">Ao clicar em "Calcular RPA", você está ciente e concorda com a nossa <a href="/pagina/privacidade">Política de Privacidade</a>, Política de Cookies e nossos Termos de Uso. Para saber mais sobre os critérios utilizados nos cálculos, <a href="#como-calcular">clique aqui</a>.</p>
                    </div>

                    <!-- RECAPTCHA VISUAL BOX -->
                    <div class="rpa-captcha-box">
                        <label class="rpa-captcha-left">
                            <input type="checkbox" id="rpa-captcha-chk" checked>
                            <span>Não sou um robô</span>
                        </label>
                        <div class="rpa-captcha-right">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="#4285f4">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14h2v2h-2zm0-10h2v8h-2z" opacity="0.3"/>
                                <path d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6 0 1.01-.25 1.97-.7 2.8l1.46 1.46C19.54 15.03 20 13.57 20 12c0-4.42-3.58-8-8-8zm-6.26 4.2L4.28 9.66C4.1 10.4 4 11.19 4 12c0 4.42 3.58 8 8 8v3l4-4-4-4v3c-3.31 0-6-2.69-6-6 0-1.29.41-2.49 1.1-3.48z"/>
                            </svg>
                            <span>reCAPTCHA</span>
                        </div>
                    </div>

                    <div>
                        <button type="button" id="rpa-btn-submit" class="rpa-btn-calc">Calcular RPA</button>
                    </div>

                    <!-- RESULTS PANEL -->
                    <div id="rpa-results-card" class="rpa-results-card">
                        <div class="rpa-results-head">
                            <h3>Demonstrativo do Recibo de Pagamento Autônomo</h3>
                            <span style="font-size: 13px; color: #64748b;">Simulação 2026</span>
                        </div>

                        <div class="rpa-results-grid">
                            <!-- RPA CARD -->
                            <div class="rpa-res-box">
                                <div class="rpa-res-title">Líquido no Bolso (RPA Autônomo):</div>
                                <div class="rpa-res-value" id="res-rpa-liquido">R$ 4.398,00</div>
                                <ul class="rpa-res-list">
                                    <li><span>Ganho Bruto:</span> <strong id="res-rpa-bruto">R$ 6.000,00</strong></li>
                                    <li><span>(-) INSS Retido (11%):</span> <strong id="res-rpa-inss" style="color: #ef4444;">- R$ 660,00</strong></li>
                                    <li><span>(-) IRRF Retido:</span> <strong id="res-rpa-irrf" style="color: #ef4444;">- R$ 642,00</strong></li>
                                    <li><span>(-) ISS Municipal (5%):</span> <strong id="res-rpa-iss" style="color: #ef4444;">- R$ 300,00</strong></li>
                                    <li style="border-top: 1px dashed #cbd5e1; padding-top: 6px; font-weight: 700;">
                                        <span>Total Descontos (RPA):</span>
                                        <strong id="res-rpa-total-desc" style="color: #dc2626;">- R$ 1.602,00 (26,7%)</strong>
                                    </li>
                                </ul>
                            </div>

                            <!-- PJ COTECH CARD -->
                            <div class="rpa-res-box highlight">
                                <div class="rpa-res-title">Líquido no Bolso como PJ (Cotech):</div>
                                <div class="rpa-res-value text-green" id="res-pj-liquido">R$ 5.445,00</div>
                                <ul class="rpa-res-list">
                                    <li><span>Faturamento Bruto:</span> <strong id="res-pj-bruto">R$ 6.000,00</strong></li>
                                    <li><span>(-) DAS Simples Nacional (6%):</span> <strong id="res-pj-imposto" style="color: #ef4444;">- R$ 360,00</strong></li>
                                    <li><span>(-) Contabilidade Cotech Completa:</span> <strong style="color: #ef4444;">- R$ 195,00</strong></li>
                                    <li><span>Honorários de Abertura CNPJ:</span> <strong style="color: #059669;">R$ 0,00 (GRÁTIS)</strong></li>
                                    <li style="border-top: 1px dashed #a7f3d0; padding-top: 6px; font-weight: 700;">
                                        <span style="color: #065f46;">Economia Líquida Cotech:</span>
                                        <strong id="res-pj-economia" style="color: #059669;">+ R$ 1.047,00 /mês</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div style="background: #e0f2fe; border-radius: 8px; padding: 14px 18px; margin-bottom: 16px; font-size: 14px; color: #0369a1;">
                            💡 <strong>Economia anual estimada:</strong> Abrindo seu CNPJ com a Cotech, você deixará de pagar <strong id="res-pj-anual">R$ 12.564,00 por ano</strong> em impostos retidos do RPA!
                        </div>

                        <div style="text-align: center;">
                            <a id="rpa-cta-link" href="/orcamento?servico=abrir-cnpj" class="cbr-btn-cyan">Quero Abrir CNPJ Grátis e Parar de Perder Dinheiro no RPA ↗</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 02. SECTION 3-STEPS (PRINT 1 BOTTOM) -->
    <section class="rpa-steps-section">
        <div class="container">
            <h2 class="rpa-steps-title">Recibo de Pagamento Autônomo (RPA)<span class="dot-cyan">.</span></h2>
            <p class="rpa-steps-sub">Saiba quando utilizar e como fazer o cálculo e a emissão.</p>

            <div class="rpa-steps-grid">
                <!-- STEP 1 -->
                <div class="rpa-step-item">
                    <div class="rpa-step-circle">1</div>
                    <h3 class="rpa-step-heading">Quando usar?</h3>
                    <p class="rpa-step-desc">Deve ser emitido pelo contratante para comprovar o pagamento a pessoas físicas sem caracterizar o vínculo CLT.</p>
                </div>

                <!-- STEP 2 -->
                <div class="rpa-step-item">
                    <div class="rpa-step-circle">2</div>
                    <h3 class="rpa-step-heading">Como calcular os impostos?</h3>
                    <p class="rpa-step-desc">Preencha o formulário acima com os seus dados para descobrir quanto você irá pagar em tributos.</p>
                </div>

                <!-- STEP 3 -->
                <div class="rpa-step-item">
                    <div class="rpa-step-circle">3</div>
                    <h3 class="rpa-step-heading">Como emitir o RPA?</h3>
                    <p class="rpa-step-desc"><a href="/orcamento?servico=rpa">Clique aqui</a> para usar gratuitamente nossa ferramenta de emissão e garantir que tudo seja calculado corretamente.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 03. SECTION O QUE É RPA (PRINT 2) -->
    <section class="rpa-info-section">
        <div class="container">
            <div class="rpa-info-grid">
                <div class="rpa-info-content">
                    <h2>O que é RPA?</h2>
                    <p>RPA é a sigla de <strong>Recibo de Pagamento Autônomo</strong>, um documento usado para formalizar o pagamento feito aos profissionais autônomos, sem caracterizar vínculo empregatício.</p>
                    <p>A emissão do RPA é feita pela empresa ou pessoa física contratante do serviço prestado. Já o recebimento do RPA é feito por qualquer profissional autônomo ou liberal que atua sem CNPJ – geralmente em profissões como médicos, advogados, psicólogos, arquitetos e engenheiros.</p>
                    <p>Além de formalizar o pagamento, o RPA também serve para que o contratante possa recolher e repassar os impostos que incidem sobre o pagamento, que são: o <strong>IRRF (Imposto de Renda Retido na Fonte)</strong>, o <strong>INSS (Previdência Social)</strong> e o <strong>ISS (Imposto Sobre Serviços)</strong>.</p>
                </div>

                <div class="rpa-consultant-col">
                    <div class="rpa-avatar-wrap">
                        <div class="rpa-avatar-circle-bg" aria-hidden="true"></div>
                        <img src="/images/rpa-maria-lima.jpg" alt="Maria Lima - Contadora Cotech" class="rpa-avatar-img" width="260" height="260">
                    </div>
                    <div class="rpa-badge-tag">
                        <strong>Maria Lima</strong>
                        <span>Contadora Cotech</span>
                        <small>CRC 1SP305136/O-3</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 04. SECTION COMO FAZER O CÁLCULO DE RPA (PRINT 2 & 3) -->
    <section class="rpa-guide-section" id="como-calcular">
        <div class="container">
            <h2>Como fazer o cálculo de RPA?</h2>

            <h3 class="rpa-underline-h3">Se o seu cliente for pessoa jurídica/empresa:</h3>
            <p>O cálculo e o pagamento dos impostos no RPA são responsabilidade da empresa contratante. Contudo, é importante que o autônomo conheça os tributos e descontos envolvidos para conferir os valores recebidos, entender os limites de desconto, declarar os recebimentos no IRPF e planejar suas finanças.</p>
            <p>O cálculo do RPA envolve <strong>três tributos que incidem na prestação de serviços</strong>: <strong>INSS</strong> (11% sobre o valor recebido, com teto), o <strong>IRRF</strong> (calculado após a dedução do INSS, conforme a tabela vigente) e o <strong>ISS</strong> (alíquota municipal, geralmente entre 2% e 5%).</p>

            <h4>INSS</h4>
            <p>O desconto do INSS é considerado para fins de aposentadoria e direito a benefícios, como licença-maternidade e auxílio-doença.</p>
            <p>Para calcular o INSS no RPA, é preciso somar todos os valores recebidos em determinado mês e aplicar a alíquota específica de 11%. Valor devido = total dos serviços x 11%.</p>
            <p>Existe um teto mensal de contribuição do INSS, atualizado todos os anos. Se a soma dos pagamentos – mesmo de diferentes contratantes – ultrapassar esse limite, o desconto de INSS não deve exceder o teto, pois qualquer valor acima disso não será considerado para o cálculo de benefícios futuros.</p>
            <p>Para evitar descontos indevidos, o autônomo pode fornecer a cada contratante uma declaração informando os valores de INSS já retidos no período.</p>
            <p>E vale destacar que para a empresa contratante, também é necessário recolher 20% como contribuição patronal sobre o mesmo valor.</p>

            <h4>IRRF</h4>
            <p>O segundo tributo é o Imposto de Renda Retido na Fonte (IRRF). O cálculo ocorre da seguinte forma: primeiro, soma-se o total recebido pela prestação de serviços no mês. Em seguida, desse valor, desconta-se o INSS já recolhido.</p>
            <p>O valor resultante é então submetido à aplicação da tabela de Imposto de Renda vigente. Diferentemente do INSS, o Imposto de Renda não possui limite máximo de desconto mensal e pode chegar a 27,5% do valor recebido.</p>
            <p>Além disso, desde 2023, com a publicação da Lei nº 14.663/2023, existem duas formas válidas para calcular o IRRF no RPA: o desconto simplificado (método novo) e a dedução legal (método tradicional). A escolha da opção mais vantajosa varia conforme o valor do INSS retido.</p>

            <h4>Novas regras do IRRF</h4>
            <p>Para pagamentos realizados via RPA, a legislação prevê que:</p>
            <ul>
                <li><strong>Até R$ 5.000,00:</strong> o IRRF é isento.</li>
                <li><strong>Entre R$ 5.000,01 e R$ 7.350,00:</strong> há desconto parcial de IRRF, ou seja, se o rendimento ficar nessa faixa, o imposto não é cobrado integralmente. Aplica-se um desconto especial sobre o valor do imposto devido, calculado pela seguinte fórmula oficial:</li>
            </ul>

            <div class="rpa-formula-callout">
                Valor do desconto = R$ 978,62 - (0,133145 × rendimento tributável mensal)
            </div>

            <ul>
                <li><strong>Acima de R$ 7.350,00:</strong> aplica-se a tabela progressiva padrão, sem esse desconto adicional.</li>
            </ul>

            <p>Essas regras podem influenciar o valor líquido recebido pelo prestador de serviços, tornando-o maior em determinados casos, especialmente nas faixas intermediárias.</p>

            <h4>ISS</h4>
            <p>Por fim, há o ISS (Imposto sobre Serviços), de responsabilidade municipal. O ISS é obrigatório para vários tipos de serviço e precisa ser recolhido para a prefeitura da cidade onde o autônomo tem cadastro.</p>
            <p>Independentemente de o autônomo ter ou não registro municipal, em muitos municípios a empresa contratante é obrigada a reter e recolher o ISS na fonte, variando de 2% a 5%. O cálculo do ISS é simples: basta multiplicar o valor total dos serviços pela alíquota definida pela legislação municipal.</p>

            <h3 class="rpa-underline-h3">Se o seu cliente for pessoa física:</h3>
            <p>Pessoas físicas não são obrigadas a reter e recolher os tributos do RPA ao contratarem um profissional autônomo. Neste caso, o próprio autônomo deve calcular, recolher e pagar os tributos devidos (INSS, IRPF e eventualmente ISS), assumindo o papel de contribuinte responsável.</p>
            <p>O INSS deve ser pago pelo autônomo via GPS (Guia da Previdência Social), o IR via Carnê-Leão e o ISS, se for devido, diretamente à prefeitura.</p>

            <!-- CTA COTECH FINAL -->
            <div style="background: #002b49; color: #ffffff; border-radius: 12px; padding: 36px 32px; text-align: center; margin-top: 40px;">
                <h3 style="color: #ffffff; font-size: 24px; margin: 0 0 10px;">Cansado de perder até 35% da sua renda em impostos no RPA?</h3>
                <p style="color: #cbd5e1; font-size: 15px; margin: 0 0 24px; max-width: 650px; margin-left: auto; margin-right: auto;">Abra sua empresa com a Cotech e pague a partir de apenas 6% de impostos no Simples Nacional. Economize milhares de reais todo mês com total segurança jurídica.</p>
                <a href="/orcamento?servico=abrir-cnpj" class="cbr-btn-cyan">Abrir meu CNPJ com Honorários Grátis ↗</a>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inBruto = document.getElementById('rpa-bruto');
    const inNome = document.getElementById('rpa-nome');
    const inEmail = document.getElementById('rpa-email');
    const inTelefone = document.getElementById('rpa-telefone');
    const selAtiv = document.getElementById('rpa-atividade');
    const btnSubmit = document.getElementById('rpa-btn-submit');
    const resultsCard = document.getElementById('rpa-results-card');

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

    setupMoneyInput(inBruto);

    // Teto INSS 2026 (~R$ 908,86 correspondente a R$ 8.262,36)
    const TETO_INSS = 908.86;

    function calcular() {
        const bruto = parseMoney(inBruto.value) || 6000;

        // 1. INSS (11% com teto)
        const inssDevido = Math.min(bruto * 0.11, TETO_INSS);

        // 2. Base IRRF = Bruto - INSS
        const baseIrrf = Math.max(0, bruto - inssDevido);

        // 3. IRRF com tabela progressiva / novas regras
        let irrf = 0;
        if (baseIrrf <= 5000) {
            irrf = 0;
        } else if (baseIrrf <= 7350) {
            // Regra parcial com desconto especial
            const impostoBruto = (baseIrrf * 0.225) - 662.77;
            const descontoEspecial = 978.62 - (0.133145 * baseIrrf);
            irrf = Math.max(0, impostoBruto - Math.max(0, descontoEspecial));
        } else {
            // Tabela padrão
            irrf = (baseIrrf * 0.275) - 896.00;
        }

        // 4. ISS municipal (média de 5% sobre o total)
        const iss = bruto * 0.05;

        // Total descontos RPA e líquido
        const totalDescontos = inssDevido + irrf + iss;
        const liquidoRpa = Math.max(0, bruto - totalDescontos);
        const percentualDescontos = (totalDescontos / bruto) * 100;

        // Cenário PJ Simples Nacional (6% Fator R)
        const impostoPj = bruto * 0.06;
        const custoContabilidade = 195.00;
        const liquidoPj = bruto - impostoPj - custoContabilidade;
        const economiaMensal = liquidoPj - liquidoRpa;
        const economiaAnual = economiaMensal * 12;

        document.getElementById('res-rpa-bruto').textContent = fmt(bruto);
        document.getElementById('res-rpa-inss').textContent = '- ' + fmt(inssDevido);
        document.getElementById('res-rpa-irrf').textContent = '- ' + fmt(irrf);
        document.getElementById('res-rpa-iss').textContent = '- ' + fmt(iss);
        document.getElementById('res-rpa-total-desc').textContent = '- ' + fmt(totalDescontos) + ' (' + percentualDescontos.toFixed(1) + '%)';
        document.getElementById('res-rpa-liquido').textContent = fmt(liquidoRpa);

        document.getElementById('res-pj-bruto').textContent = fmt(bruto);
        document.getElementById('res-pj-imposto').textContent = '- ' + fmt(impostoPj);
        document.getElementById('res-pj-liquido').textContent = fmt(liquidoPj);
        document.getElementById('res-pj-economia').textContent = (economiaMensal >= 0 ? '+ ' : '') + fmt(economiaMensal) + ' /mês';
        document.getElementById('res-pj-anual').textContent = fmt(economiaAnual) + ' por ano';

        const ctaLink = document.getElementById('rpa-cta-link');
        if (ctaLink) {
            ctaLink.href = `/orcamento?servico=abrir-cnpj&faturamento=${encodeURIComponent(bruto)}&rpa_liquido=${encodeURIComponent(liquidoRpa)}`;
        }

        resultsCard.classList.add('show');
        resultsCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    btnSubmit?.addEventListener('click', calcular);
});
</script>
@endsection
