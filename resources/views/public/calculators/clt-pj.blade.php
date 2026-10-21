@extends('layouts.public')
@section('title', 'Calculadora CLT x PJ: Compare Salário Líquido e Vantagens | Cotech')
@section('description', 'Simule grátis a comparação entre salário CLT e contrato PJ. Descubra quanto faturar como CNPJ para ganhar mais, considerando impostos, benefícios, 13º e férias.')

@section('content')
<!-- BREADCRUMB -->
<div class="calc-breadcrumb-bar">
    <div class="container">
        <nav aria-label="Navegação estrutural">
            <a href="/">Início</a>
            <span class="sep">/</span>
            <a href="/calculadoras">Calculadoras</a>
            <span class="sep">/</span>
            <span class="current">Calculadora PJ x CLT</span>
        </nav>
    </div>
</div>

<!-- HERO DA PÁGINA -->
<div class="calc-page-hero">
    <div class="container" data-reveal>
        <span class="eyebrow">SIMULADOR COMPARATIVO EXCLUSIVO</span>
        <h1>Calculadora PJ x CLT<br><span class="ink-blue">compare ganhos reais no bolso</span></h1>
        <p class="muted">Recebeu uma proposta para virar PJ ou quer saber se compensa sair da CLT? Compare os salários líquidos, benefícios, 13º, férias, FGTS e impostos do Simples Nacional para tomar a melhor decisão financeira.</p>
    </div>
</div>

<!-- SECTION CALCULADORA INTERATIVA -->
<section class="section calc-main-section">
    <div class="container">
        <div class="calc-card-grid">
            <!-- INPUTS COMPARADOR -->
            <div class="calc-inputs-card" data-reveal>
                <div class="calc-card-header">
                    <span class="calc-step-tag">DADOS DA SIMULAÇÃO</span>
                    <h3>Informe os dados do contrato</h3>
                    <p class="calc-subtitle">Preencha os valores para simular os ganhos mensais e anuais em cada modelo de contratação.</p>
                </div>

                <div class="calc-subheading">1. Cenário CLT (Carteira Assinada)</div>
                <div class="calc-form-group">
                    <label for="clt-bruto">Salário Bruto CLT (R$) *</label>
                    <input type="number" id="clt-bruto" class="calc-input" value="8000" min="1518" step="100">
                    <small class="calc-field-help">Salário nominal registrado na carteira de trabalho.</small>
                </div>

                <div class="calc-form-group">
                    <label for="clt-dependentes">Número de Dependentes (para dedução do IRPF)</label>
                    <input type="number" id="clt-dependentes" class="calc-input" value="0" min="0" max="10">
                </div>

                <div class="calc-form-group">
                    <label for="clt-beneficios">Total de Benefícios CLT Mensais (VR, VA, Saúde em R$)</label>
                    <input type="number" id="clt-beneficios" class="calc-input" value="1200" min="0" step="50">
                    <small class="calc-field-help">Soma dos valores de vale refeição, alimentação e subsídio do plano de saúde.</small>
                </div>

                <div class="calc-subheading" style="margin-top: 24px;">2. Cenário PJ (Pessoa Jurídica)</div>
                <div class="calc-form-group">
                    <label for="pj-faturamento">Pretensão ou Proposta PJ Mensal (R$) *</label>
                    <input type="number" id="pj-faturamento" class="calc-input" value="13000" min="2000" step="500">
                    <small class="calc-tip">💡 <strong>Regra de mercado:</strong> Para empatar ou superar a CLT com benefícios, o valor PJ geralmente varia entre 1.4x e 1.7x o salário CLT.</small>
                </div>

                <div class="calc-form-group">
                    <label for="pj-regime">Regime Tributário PJ</label>
                    <select id="pj-regime" class="calc-input">
                        <option value="simples-anexo3" selected>Simples Nacional — Anexo III (6% c/ Fator R otimizado Cotech)</option>
                        <option value="simples-anexo5">Simples Nacional — Anexo V (15,5% sem Fator R)</option>
                        <option value="lucro-presumido">Lucro Presumido (aprox. 16,33% PIS/COFINS/IRPJ/CSLL/ISS)</option>
                    </select>
                </div>

                <div class="calc-form-group">
                    <label for="pj-mensalidade">Honorários Contábeis Cotech Mensal (R$)</label>
                    <input type="number" id="pj-mensalidade" class="calc-input" value="189" min="0" step="10">
                </div>

                <button type="button" class="button blue-button full-width" id="btn-calc-clt-pj">Comparar Agora ↗</button>
            </div>

            <!-- RESULTADOS SIDE BY SIDE -->
            <div class="calc-results-card" data-reveal>
                <span class="calc-badge-green">COMPARATIVO LÍQUIDO REAL</span>

                <div class="clt-pj-comparison-grid">
                    <!-- COLUNA CLT -->
                    <div class="comparison-column clt-col">
                        <span class="comp-tag">REGIME CLT</span>
                        <div class="comp-value" id="res-clt-liquido">R$ 6.320,00</div>
                        <small>Líquido em conta todo mês</small>
                        <ul class="comp-details">
                            <li>Desconto INSS: <span id="res-clt-inss">- R$ 908,00</span></li>
                            <li>Desconto IRPF: <span id="res-clt-irpf">- R$ 772,00</span></li>
                            <li>Benefícios mensais: <span id="res-clt-benef-val">+ R$ 1.200,00</span></li>
                            <li>13º Salário (anual): <span id="res-clt-13">+ R$ 6.320,00</span></li>
                            <li>Férias + 1/3 (anual): <span id="res-clt-ferias">+ R$ 8.426,00</span></li>
                            <li>FGTS 8% (anual): <span id="res-clt-fgts">+ R$ 7.680,00</span></li>
                            <li class="comp-highlight-row">Total Anual CLT (c/ direitos): <strong id="res-clt-anual">R$ 104.546</strong></li>
                        </ul>
                    </div>

                    <!-- COLUNA PJ -->
                    <div class="comparison-column pj-col">
                        <span class="comp-tag pj-tag">COMO PJ NA COTECH</span>
                        <div class="comp-value text-green" id="res-pj-liquido">R$ 11.603,00</div>
                        <small>Líquido no seu bolso todo mês</small>
                        <ul class="comp-details">
                            <li>Faturamento bruto: <span id="res-pj-fat-val">R$ 13.000,00</span></li>
                            <li>Imposto DAS (Simples): <span id="res-pj-imposto">- R$ 780,00</span></li>
                            <li>Pró-labore + INSS (11%): <span id="res-pj-inss">- R$ 428,00</span></li>
                            <li>Contabilidade Cotech: <span id="res-pj-contab">- R$ 189,00</span></li>
                            <li>Economia de encargos: <span class="text-green">Otimizado Anexo III</span></li>
                            <li class="comp-highlight-row">Total Anual PJ Líquido: <strong class="text-green" id="res-pj-anual">R$ 139.236</strong></li>
                        </ul>
                    </div>
                </div>

                <!-- VEREDITO / BANNER DE VITÓRIA -->
                <div class="calc-winner-banner" id="res-banner-box">
                    <span class="winner-icon">🚀</span>
                    <div>
                        <strong id="res-winner-title">Ganho Extra como PJ: <span class="text-green" id="res-pj-diferenca">+ R$ 34.690 / ano</span></strong>
                        <p id="res-winner-desc">Como PJ com a assessoria da Cotech, você mantém muito mais recursos no seu bolso para investir, criar sua reserva e ter flexibilidade financeira.</p>
                    </div>
                </div>

                <div class="calc-breakdown-list" style="margin-top: 15px;">
                    <div class="breakdown-item highlight-saving">
                        <span>Valor PJ recomendado p/ empatar o pacote CLT:</span>
                        <strong class="text-blue" id="res-pj-minimo">R$ 9.850,00 / mês</strong>
                    </div>
                </div>

                <div class="calc-cta-box">
                    <a class="button blue-button full-width" href="/orcamento?servico=transicao-pj">Fazer Transição para PJ com a Cotech ↗</a>
                    <span class="calc-security-note">🔒 Cuidamos da abertura do seu CNPJ, contratos e emissão de notas.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SEÇÃO EDUCATIVA: DIFERENÇAS CLT X PJ -->
<section class="section calc-info-section">
    <div class="container" data-reveal>
        <span class="eyebrow">ANÁLISE ESTRATÉGICA</span>
        <h2>CLT vs PJ: Como saber qual modelo escolher?</h2>
        <p class="muted">A escolha entre trabalhar com carteira assinada ou como prestador de serviços através de uma empresa própria depende dos seus objetivos de carreira, remuneração e estabilidade:</p>

        <div class="calc-info-grid">
            <div class="calc-info-card">
                <div class="calc-info-icon">📋</div>
                <h3>Regime CLT: Segurança e Direitos</h3>
                <p>O profissional CLT tem garantias trabalhistas como férias remuneradas com 1/3, 13º salário, FGTS com multa rescisória de 40%, aviso prévio e seguro-desemprego. Em contrapartida, os descontos de INSS e Imposto de Renda chegam a até 27,5% na fonte, diminuindo bastante o salário líquido.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">💼</div>
                <h3>Modelo PJ: Maior Ganho Líquido</h3>
                <p>Como Pessoa Jurídica, a remuneração mensal bruta costuma ser substancialmente superior (geralmente de 40% a 70% a mais). No Simples Nacional com apoio da Cotech, você tributa sua receita a partir de apenas 6%, acumulando patrimônio de forma muito mais veloz.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🏖️</div>
                <h3>Flexibilidade e Férias no PJ</h3>
                <p>Contratos de prestação de serviços PJ modernos frequentemente incluem cláusulas de descanso remunerado acordadas entre as partes (ex: 20 a 30 dias de recesso anual). Além disso, você tem autonomia para atender mais de um cliente simultaneamente.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🛡️</div>
                <h3>Como Criar Sua Proteção como PJ</h3>
                <p>Para atuar como PJ com total tranquilidade, o profissional deve reservar parte do ganho extra para construir uma reserva de emergência (6 meses de custo de vida), contratar plano de saúde individual e manter contribuição previdenciária ou privada.</p>
            </div>
        </div>
    </div>
</section>

<!-- TABELA COMPARATIVA DETALHADA -->
<section class="section calc-table-section">
    <div class="container" data-reveal>
        <span class="eyebrow">RAIO-X COMPARATIVO</span>
        <h2>Tabela de Benefícios e Obrigações</h2>
        <p class="muted">Confira lado a lado como cada regime funciona na legislação brasileira:</p>

        <div class="table-wrap">
            <table class="calc-comparison-table">
                <thead>
                    <tr>
                        <th>Aspecto</th>
                        <th>CLT (Carteira Assinada)</th>
                        <th>PJ (Prestador de Serviços)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Impostos e Descontos</strong></td>
                        <td>INSS (até 14%) + IRPF (até 27,5%) retidos na folha</td>
                        <td>Simples Nacional a partir de 6% (Anexo III)</td>
                    </tr>
                    <tr>
                        <td><strong>13º e Férias + 1/3</strong></td>
                        <td>Obrigatórios por lei</td>
                        <td>Compensados pelo valor maior ou negociados em contrato</td>
                    </tr>
                    <tr>
                        <td><strong>FGTS</strong></td>
                        <td>8% pago pela empresa + multa de 40% na demissão</td>
                        <td>Substituído pela sua própria reserva de investimentos</td>
                    </tr>
                    <tr>
                        <td><strong>Múltiplos Clientes</strong></td>
                        <td>Raro (exige autorização ou compatibilidade)</td>
                        <td>Total liberdade para emitir notas para vários clientes</td>
                    </tr>
                    <tr>
                        <td><strong>Abertura de Empresa</strong></td>
                        <td>Não se aplica</td>
                        <td><strong class="text-green">Grátis nos planos da Cotech</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- FAQ ESPECÍFICO DE CLT X PJ -->
<section class="section calc-faq-section">
    <div class="container" data-reveal>
        <span class="eyebrow">PERGUNTAS E RESPOSTAS</span>
        <h2>Dúvidas frequentes sobre CLT x PJ</h2>

        <div class="faq-accordion-list">
            <details class="faq-item">
                <summary>A partir de qual valor realmente compensa virar PJ?</summary>
                <div class="faq-answer">
                    <p>Em geral, para salários CLT a partir de <strong>R$ 5.000 a R$ 6.000</strong>, a migração para PJ torna-se altamente vantajosa financeiramente, desde que a proposta PJ ofereça um acréscimo de pelo menos 40% sobre o salário bruto para cobrir férias, 13º e plano de saúde.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Quem é PJ tem direito a aposentadoria pelo INSS?</summary>
                <div class="faq-answer">
                    <p>Sim! Ao retirar o <strong>pró-labore</strong> da sua empresa (a remuneração mensal do sócio administrador), você recolhe a contribuição obrigatória do INSS (11%), mantendo a qualidade de segurado da Previdência Social para aposentadoria, auxílio-doença e licença maternidade.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>O que é a Pejotização e quais os cuidados legais?</summary>
                <div class="faq-answer">
                    <p>A relação PJ é uma contratação entre duas empresas (B2B). Para ter segurança jurídica, a prestação de serviços não deve conter elementos estritos de subordinação hierárquica direta, controle rígido de ponto físico ou exclusividade impositiva. A Cotech orienta você com minutas contratuais seguras.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Como a Cotech me ajuda na transição de CLT para PJ?</summary>
                <div class="faq-answer">
                    <p>Cuidamos de tudo: abrimos seu CNPJ grátis, definimos o CNAE ideal com alíquota inicial de 6% no Simples Nacional, emitimos suas notas fiscais todo mês, calculamos seus impostos e pró-labore e garantimos conformidade total com a Receita Federal.</p>
                </div>
            </details>
        </div>
    </div>
</section>

<!-- CALL TO ACTION FINAL -->
<section class="section calc-final-cta">
    <div class="container" data-reveal>
        <div class="srv-callout-card">
            <div class="srv-callout-content">
                <span class="srv-callout-tag">PLANEJE SUA TRANSIÇÃO</span>
                <h2>Quer analisar sua proposta com um especialista?</h2>
                <p>Nossos contadores avaliam sua proposta de trabalho atual ou nova oferta e mostram exatamente como maximizar seus rendimentos como PJ.</p>
                <div class="srv-callout-actions">
                    <a class="button blue-button" href="/orcamento?servico=transicao-pj">Solicitar Consultoria PJ Gratuita <span>↗</span></a>
                    <a class="button srv-button-ghost" href="/calculadoras">Explorar Outras Calculadoras <span>↗</span></a>
                </div>
            </div>
            <div class="srv-callout-image">
                <img src="/images/specialist-tablet.jpg" alt="Consultor Cotech comparando CLT e PJ" width="460" height="420" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- JAVASCRIPT DO CÁLCULO CLT X PJ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inBruto = document.getElementById('clt-bruto');
    const inDep = document.getElementById('clt-dependentes');
    const inBenef = document.getElementById('clt-beneficios');
    const inFatPj = document.getElementById('pj-faturamento');
    const selRegime = document.getElementById('pj-regime');
    const inMensalidade = document.getElementById('pj-mensalidade');
    const btnCalc = document.getElementById('btn-calc-clt-pj');

    function calcInssClt(salario) {
        // Tabela progressiva INSS
        const teto = 7786.02;
        let base = Math.min(salario, teto);
        let inss = 0;
        if (base <= 1518.00) {
            inss = base * 0.075;
        } else if (base <= 2793.88) {
            inss = (1518.00 * 0.075) + ((base - 1518.00) * 0.09);
        } else if (base <= 4190.83) {
            inss = (1518.00 * 0.075) + ((2793.88 - 1518.00) * 0.09) + ((base - 2793.88) * 0.12);
        } else {
            inss = (1518.00 * 0.075) + ((2793.88 - 1518.00) * 0.09) + ((4190.83 - 2793.88) * 0.12) + ((base - 4190.83) * 0.14);
        }
        return inss;
    }

    function calcIrpfClt(salario, inss, dependentes) {
        let base = salario - inss - (dependentes * 189.59);
        let ir = 0;
        if (base <= 2259.20) {
            ir = 0;
        } else if (base <= 2826.65) {
            ir = (base * 0.075) - 169.44;
        } else if (base <= 3751.05) {
            ir = (base * 0.15) - 381.44;
        } else if (base <= 4664.68) {
            ir = (base * 0.225) - 662.77;
        } else {
            ir = (base * 0.275) - 896.00;
        }
        return Math.max(0, ir);
    }

    function calcular() {
        const salarioClt = parseFloat(inBruto.value) || 8000;
        const dep = parseInt(inDep.value) || 0;
        const benef = parseFloat(inBenef.value) || 0;
        const fatPj = parseFloat(inFatPj.value) || 13000;
        const regime = selRegime.value || 'simples-anexo3';
        const mensalidadeContab = parseFloat(inMensalidade.value) || 189;

        // Cálculos CLT
        const inssClt = calcInssClt(salarioClt);
        const irpfClt = calcIrpfClt(salarioClt, inssClt, dep);
        const liquidoCltMensal = salarioClt - inssClt - irpfClt;

        const decimoTerceiro = salarioClt - calcInssClt(salarioClt) - calcIrpfClt(salarioClt, calcInssClt(salarioClt), dep);
        const feriasUmTerco = (salarioClt * 4 / 3) - calcInssClt(salarioClt * 4 / 3) - calcIrpfClt(salarioClt * 4 / 3, calcInssClt(salarioClt * 4 / 3), dep);
        const fgtsAnual = salarioClt * 0.08 * 12;
        const benefAnual = benef * 12;
        const anualCltTotal = (liquidoCltMensal * 12) + decimoTerceiro + (feriasUmTerco - liquidoCltMensal) + fgtsAnual + benefAnual;

        // Cálculos PJ
        let aliquotaImposto = 0.06;
        if (regime === 'simples-anexo5') aliquotaImposto = 0.155;
        if (regime === 'lucro-presumido') aliquotaImposto = 0.1633;

        const impostoPj = fatPj * aliquotaImposto;
        const proLabore = Math.max(1518, fatPj * 0.28);
        const inssPj = Math.min(proLabore * 0.11, 7786.02 * 0.11);
        const liquidoPjMensal = fatPj - impostoPj - inssPj - mensalidadeContab;
        const anualPjTotal = liquidoPjMensal * 12;

        const diferencaAnual = anualPjTotal - anualCltTotal;
        const pjMinimoIdeal = (anualCltTotal / 12) / (1 - aliquotaImposto - 0.03);

        const fmt = val => 'R$ ' + Math.round(val).toLocaleString('pt-BR');

        // Preencher CLT
        document.getElementById('res-clt-liquido').textContent = fmt(liquidoCltMensal);
        document.getElementById('res-clt-inss').textContent = '- ' + fmt(inssClt);
        document.getElementById('res-clt-irpf').textContent = '- ' + fmt(irpfClt);
        document.getElementById('res-clt-benef-val').textContent = '+ ' + fmt(benef);
        document.getElementById('res-clt-13').textContent = '+ ' + fmt(decimoTerceiro);
        document.getElementById('res-clt-ferias').textContent = '+ ' + fmt(feriasUmTerco);
        document.getElementById('res-clt-fgts').textContent = '+ ' + fmt(fgtsAnual);
        document.getElementById('res-clt-anual').textContent = fmt(anualCltTotal);

        // Preencher PJ
        document.getElementById('res-pj-liquido').textContent = fmt(liquidoPjMensal);
        document.getElementById('res-pj-fat-val').textContent = fmt(fatPj);
        document.getElementById('res-pj-imposto').textContent = '- ' + fmt(impostoPj);
        document.getElementById('res-pj-inss').textContent = '- ' + fmt(inssPj);
        document.getElementById('res-pj-contab').textContent = '- ' + fmt(mensalidadeContab);
        document.getElementById('res-pj-anual').textContent = fmt(anualPjTotal);

        // Veredito
        const bannerTitle = document.getElementById('res-winner-title');
        const bannerDesc = document.getElementById('res-winner-desc');
        const diferencaSpan = document.getElementById('res-pj-diferenca');
        const pjMinimoEl = document.getElementById('res-pj-minimo');

        pjMinimoEl.textContent = fmt(pjMinimoIdeal) + ' / mês';

        if (diferencaAnual > 0) {
            bannerTitle.innerHTML = `Ganho Extra como PJ: <span class="text-green">+ ${fmt(diferencaAnual)} / ano</span>`;
            bannerDesc.textContent = `Vantagem clara para PJ! Você recebe ${fmt(liquidoPjMensal - liquidoCltMensal)} a mais todo mês, superando com folga o 13º e férias da CLT.`;
        } else {
            bannerTitle.innerHTML = `Neste valor, a CLT está empatada ou superior: <span style="color: #ea580c;">${fmt(Math.abs(diferencaAnual))} / ano</span>`;
            bannerDesc.innerHTML = `Para valer a pena a transição para PJ, sugerimos negociar sua remuneração para pelo menos <strong>${fmt(pjMinimoIdeal)}/mês</strong>.`;
        }
    }

    btnCalc?.addEventListener('click', calcular);
    inBruto?.addEventListener('input', calcular);
    inDep?.addEventListener('input', calcular);
    inBenef?.addEventListener('input', calcular);
    inFatPj?.addEventListener('input', calcular);
    selRegime?.addEventListener('change', calcular);
    inMensalidade?.addEventListener('input', calcular);

    calcular();
});
</script>
@endsection
