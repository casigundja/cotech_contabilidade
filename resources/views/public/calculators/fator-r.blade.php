@extends('layouts.public')
@section('title', 'Calculadora de Fator R Simples Nacional | Pague 6% de Imposto | Cotech')
@section('description', 'Calcule grátis o Fator R da sua empresa. Descubra se você se enquadra no Anexo III (6%) ou Anexo V (15,5%) do Simples Nacional e veja como reduzir seus impostos.')

@section('content')
<!-- BREADCRUMB -->
<div class="calc-breadcrumb-bar">
    <div class="container">
        <nav aria-label="Navegação estrutural">
            <a href="/">Início</a>
            <span class="sep">/</span>
            <a href="/calculadoras">Calculadoras</a>
            <span class="sep">/</span>
            <span class="current">Calculadora de Fator R</span>
        </nav>
    </div>
</div>

<!-- HERO DA PÁGINA -->
<div class="calc-page-hero">
    <div class="container" data-reveal>
        <span class="eyebrow">PLANEJAMENTO TRIBUTÁRIO SIMPLES NACIONAL</span>
        <h1>Calculadora de Fator R<br><span class="ink-blue">pague 6% em vez de 15,5% de imposto</span></h1>
        <p class="muted">O Fator R é o cálculo que define se a sua empresa de serviços será tributada pelo Anexo III (alíquota inicial de 6%) ou pelo Anexo V (alíquota inicial de 15,5%). Simule seus números e descubra a economia real.</p>
    </div>
</div>

<!-- SECTION CALCULADORA INTERATIVA -->
<section class="section calc-main-section">
    <div class="container">
        <div class="calc-card-grid">
            <!-- FORMULÁRIO DE ENTRADA -->
            <div class="calc-inputs-card" data-reveal>
                <div class="calc-card-header">
                    <span class="calc-step-tag">SIMULAÇÃO FISCAL</span>
                    <h3>Calcule o enquadramento da sua empresa</h3>
                    <p class="calc-subtitle">Preencha os dados de faturamento e despesas com folha e pró-labore dos últimos 12 meses (ou média mensal).</p>
                </div>

                <div class="calc-form-group">
                    <label for="fator-atividade">1. Qual a atividade da sua empresa? *</label>
                    <select id="fator-atividade" class="calc-input">
                        <option value="ti" selected>Desenvolvimento de Software / TI / Dados / Cyber</option>
                        <option value="consultoria">Consultoria Empresarial / Gestão / Finanças</option>
                        <option value="marketing">Marketing Digital / Publicidade / Design / Criação</option>
                        <option value="engenharia">Engenharia / Arquitetura / Agronomia</option>
                        <option value="saude">Medicina / Psicologia / Odontologia / Fisioterapia</option>
                        <option value="advocacia">Serviços Jurídicos / Advocacia</option>
                        <option value="outra">Outras atividades de prestação de serviços</option>
                    </select>
                </div>

                <div class="calc-form-group">
                    <label for="fator-faturamento">2. Faturamento Bruto Médio Mensal (R$) *</label>
                    <input type="number" id="fator-faturamento" class="calc-input" value="20000" min="1000" step="1000">
                    <small class="calc-field-help">Valor total das notas fiscais emitidas no mês (ou média dos últimos 12 meses).</small>
                </div>

                <div class="calc-form-group">
                    <label for="fator-folha">3. Folha de Pagamento Total Mensal (R$) *</label>
                    <input type="number" id="fator-folha" class="calc-input" value="6000" min="0" step="500">
                    <small class="calc-field-help">Soma de salários de empregados, encargos sociais (INSS/FGTS) e <strong>pró-labore retirado pelos sócios</strong>.</small>
                </div>

                <div class="calc-form-group">
                    <div class="calc-toggles-row">
                        <label class="calc-checkbox-label">
                            <input type="checkbox" id="fator-tem-prolabore" checked>
                            <span>Os sócios já retiram Pró-labore mensal</span>
                        </label>
                        <label class="calc-checkbox-label">
                            <input type="checkbox" id="fator-tem-funcionarios">
                            <span>A empresa possui funcionários registrados</span>
                        </label>
                    </div>
                </div>

                <button type="button" class="button blue-button full-width" id="btn-calc-fator">Calcular Fator R Agora ↗</button>
            </div>

            <!-- RESULTADOS DO FATOR R -->
            <div class="calc-results-card" data-reveal>
                <span class="calc-badge-green">DIAGNÓSTICO FISCAL</span>

                <div class="calc-result-header">
                    <small>Seu Fator R Calculado:</small>
                    <div class="calc-big-value" id="res-fator-percent">30,0%</div>
                    <div class="fator-badge-status" id="res-fator-badge" style="background: #10b981;">ANEXO III — 6% DE IMPOSTO</div>
                </div>

                <div class="calc-breakdown-list">
                    <div class="breakdown-item">
                        <span>Alíquota Inicial Aplicada:</span>
                        <strong id="res-fator-aliquota">6,0% (Anexo III)</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Imposto Simples Nacional (DAS):</span>
                        <strong class="text-blue" id="res-fator-imposto">R$ 1.200,00 / mês</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Imposto se tributado no Anexo V:</span>
                        <strong class="text-strike" id="res-fator-anexo5">R$ 3.100,00 / mês</strong>
                    </div>
                    <div class="breakdown-item highlight-saving">
                        <span>Economia Mensal com a Cotech:</span>
                        <strong class="text-green" id="res-fator-economia">R$ 1.900,00 / mês</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Economia Anual Estimada:</span>
                        <strong class="text-green" id="res-fator-anual">R$ 22.800,00 / ano</strong>
                    </div>
                </div>

                <!-- ALERTA / ORIENTAÇÃO INTELIGENTE -->
                <div class="calc-fator-advice" id="res-fator-advice">
                    <p>✓ <strong>Excelente resultado!</strong> Seu Fator R é de 30%, superando a meta legal de 28%. A Cotech assegura a apuração mensal correta para você recolher impostos pela menor alíquota permitida por lei.</p>
                </div>

                <div class="calc-cta-box">
                    <a class="button blue-button full-width" href="/orcamento?servico=fator-r">Otimizar Meus Impostos na Cotech ↗</a>
                    <span class="calc-security-note">🔒 Contabilidade estratégica sem risco de autuações fiscais.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SEÇÃO EDUCATIVA: O QUE É FATOR R -->
<section class="section calc-info-section">
    <div class="container" data-reveal>
        <span class="eyebrow">ENTENDA AS REGRAS</span>
        <h2>O que é o Fator R e como funciona a regra dos 28%?</h2>
        <p class="muted">Criado pela Lei Complementar nº 155/2016, o Fator R é um mecanismo do Simples Nacional que premia empresas de serviços que investem em remuneração de pessoas (folha de salários e pró-labore):</p>

        <div class="calc-info-grid">
            <div class="calc-info-card">
                <div class="calc-info-icon">📊</div>
                <h3>A Regra Matemática dos 28%</h3>
                <p>O Fator R é a divisão simples entre o valor total gasto com folha de pagamento nos últimos 12 meses e a receita bruta do mesmo período. Se a razão for <strong>igual ou superior a 28%</strong>, a empresa é tributada pelo favorável <strong>Anexo III (a partir de 6%)</strong>. Se for menor que 28%, cai no pesado <strong>Anexo V (a partir de 15,5%)</strong>.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">💡</div>
                <h3>Estratégia do Pró-labore Inteligente</h3>
                <p>Mesmo que você não tenha funcionários registrados, o <strong>pró-labore dos sócios conta como folha de pagamento</strong>! A Cotech calcula rigorosamente todo mês qual deve ser sua retirada de pró-labore para manter seu Fator R cravado acima de 28%, gerando economia líquida enorme.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🎯</div>
                <h3>Atividades Beneficiadas</h3>
                <p>Desenvolvedores de software, profissionais de TI, engenheiros, arquitetos, publicitários, médicos, psicólogos, consultores de negócios e diversas outras profissões regulamentadas estão na lista que pode usufruir do Fator R.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🛡️</div>
                <h3>Monitoramento Contínuo Cotech</h3>
                <p>Nosso sistema monitora as oscilações do seu faturamento mês a mês para recalcular o pró-labore preventivamente. Você nunca é surpreendido com guias de DAS com alíquotas do Anexo V.</p>
            </div>
        </div>
    </div>
</section>

<!-- TABELA COMPARATIVA ANEXO III VS ANEXO V -->
<section class="section calc-table-section">
    <div class="container" data-reveal>
        <span class="eyebrow">COMPARAÇÃO DIRETA</span>
        <h2>Diferença de Alíquotas: Anexo III vs Anexo V</h2>
        <p class="muted">Veja o impacto real na sua fatura de impostos conforme as faixas de faturamento do Simples Nacional:</p>

        <div class="table-wrap">
            <table class="calc-comparison-table">
                <thead>
                    <tr>
                        <th>Faixa de Receita Anual</th>
                        <th>Alíquota Anexo III (Fator R ≥ 28%)</th>
                        <th>Alíquota Anexo V (Fator R &lt; 28%)</th>
                        <th>Sua Economia com a Cotech</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Até R$ 180.000 / ano</strong></td>
                        <td><strong class="text-green">6,00%</strong></td>
                        <td>15,50%</td>
                        <td><strong class="text-green">Economia de 9,5% do faturamento!</strong></td>
                    </tr>
                    <tr>
                        <td><strong>De R$ 180.000 a R$ 360.000</strong></td>
                        <td><strong class="text-green">11,20%</strong></td>
                        <td>18,00%</td>
                        <td><strong class="text-green">Economia de 6,8%</strong></td>
                    </tr>
                    <tr>
                        <td><strong>De R$ 360.000 a R$ 720.000</strong></td>
                        <td><strong class="text-green">13,50%</strong></td>
                        <td>19,50%</td>
                        <td><strong class="text-green">Economia de 6,0%</strong></td>
                    </tr>
                    <tr>
                        <td><strong>De R$ 720.000 a R$ 1.800.000</strong></td>
                        <td><strong class="text-green">16,00%</strong></td>
                        <td>20,50%</td>
                        <td><strong class="text-green">Economia de 4,5%</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- FAQ ESPECÍFICO DE FATOR R -->
<section class="section calc-faq-section">
    <div class="container" data-reveal>
        <span class="eyebrow">PERGUNTAS FREQUENTES</span>
        <h2>Dúvidas comuns sobre o Fator R</h2>

        <div class="faq-accordion-list">
            <details class="faq-item">
                <summary>Como calcular o Fator R de uma empresa aberta há menos de 12 meses?</summary>
                <div class="faq-answer">
                    <p>Para empresas recentes que ainda não completaram 12 meses de atividade, a Receita Federal utiliza uma regra de proporcionalização: no primeiro mês, multiplica-se a folha e o faturamento por 12; nos meses seguintes, calcula-se a média aritmética dos meses anteriores multiplicada por 12.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>O que conta exatamente como despesa de Folha de Pagamento?</summary>
                <div class="faq-answer">
                    <p>Entram na conta: o valor bruto dos salários dos funcionários CLT, 13º salário, férias pagas, o <strong>pró-labore dos sócios</strong> e os encargos patronais previdenciários e FGTS recolhidos.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Vale a pena aumentar o pró-labore apenas para atingir 28%?</summary>
                <div class="faq-answer">
                    <p>Na grande maioria esmagadora dos casos, <strong>sim!</strong> Mesmo recolhendo os 11% de INSS sobre a diferença do pró-labore, a redução da alíquota do imposto da nota (de 15,5% para 6%) gera uma economia líquida muito maior. Nossa equipe faz esse cálculo exato para você todo mês.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Se a minha empresa faturar menos em um mês, perco o enquadramento no Anexo III?</summary>
                <div class="faq-answer">
                    <p>Como o cálculo considera o acumulado dos últimos 12 meses (RBT12 e Folha12), uma oscilação pontual em um único mês não costuma derrubar o enquadramento imediatamente. A Cotech monitora a média móvel para prevenir qualquer desenquadramento.</p>
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
                <span class="srv-callout-tag">GESTÃO FISCAL COTECH</span>
                <h2>Pare de pagar imposto a mais por falta de planejamento</h2>
                <p>Nossos contadores assumem a gestão completa do Simples Nacional da sua empresa, garantindo que você usufrua do Anexo III com total segurança jurídica.</p>
                <div class="srv-callout-actions">
                    <a class="button blue-button" href="/orcamento?servico=fator-r">Otimizar Meus Impostos Agora <span>↗</span></a>
                    <a class="button srv-button-ghost" href="/calculadoras">Ver Outras Calculadoras <span>↗</span></a>
                </div>
            </div>
            <div class="srv-callout-image">
                <img src="/images/specialist-tablet.jpg" alt="Consultor Cotech planejando Fator R" width="460" height="420" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- JAVASCRIPT DO CÁLCULO FATOR R -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inFat = document.getElementById('fator-faturamento');
    const inFolha = document.getElementById('fator-folha');
    const selAtiv = document.getElementById('fator-atividade');
    const btnCalc = document.getElementById('btn-calc-fator');

    function calcular() {
        const fat = parseFloat(inFat.value) || 20000;
        const folha = parseFloat(inFolha.value) || 0;
        const ratio = fat > 0 ? (folha / fat) * 100 : 0;

        const percentEl = document.getElementById('res-fator-percent');
        const badge = document.getElementById('res-fator-badge');
        const aliquotaEl = document.getElementById('res-fator-aliquota');
        const impostoEl = document.getElementById('res-fator-imposto');
        const anexo5El = document.getElementById('res-fator-anexo5');
        const economiaEl = document.getElementById('res-fator-economia');
        const anualEl = document.getElementById('res-fator-anual');
        const advice = document.getElementById('res-fator-advice');

        percentEl.textContent = ratio.toFixed(1).replace('.', ',') + '%';

        const fmt = val => 'R$ ' + Math.round(val).toLocaleString('pt-BR');

        const impostoAnexo5 = fat * 0.155;
        const impostoAnexo3 = fat * 0.06;
        const folhaMinima28 = fat * 0.28;

        if (ratio >= 28) {
            badge.textContent = "ANEXO III — 6% DE IMPOSTO (ENQUADRADO)";
            badge.style.background = "#10b981";
            aliquotaEl.textContent = "6,0% (Anexo III)";
            impostoEl.textContent = fmt(impostoAnexo3) + ' / mês';
            anexo5El.textContent = fmt(impostoAnexo5) + ' / mês';
            const econ = impostoAnexo5 - impostoAnexo3;
            economiaEl.textContent = fmt(econ) + ' / mês';
            anualEl.textContent = fmt(econ * 12) + ' / ano';

            advice.innerHTML = `<p>✓ <strong>Excelente resultado!</strong> Seu Fator R é de ${ratio.toFixed(1).replace('.', ',')}%, superando a meta legal de 28%. A Cotech assegura a apuração mensal correta para você recolher impostos pela menor alíquota permitida por lei.</p>`;
        } else {
            badge.textContent = "ALERTA: ANEXO V — 15,5% DE IMPOSTO";
            badge.style.background = "#ef4444";
            aliquotaEl.textContent = "15,5% (Anexo V)";
            impostoEl.textContent = fmt(impostoAnexo5) + ' / mês';
            anexo5El.textContent = fmt(impostoAnexo5) + ' / mês';
            economiaEl.textContent = "R$ 0,00 (Sem benefício atual)";
            anualEl.textContent = "R$ 0,00";

            const diffFolha = folhaMinima28 - folha;
            const economiaPotencial = impostoAnexo5 - impostoAnexo3;

            advice.innerHTML = `<p>⚠️ <strong>Alerta de economia:</strong> Seu Fator R está em ${ratio.toFixed(1).replace('.', ',')}% (abaixo dos 28%). Com a assessoria da Cotech, ajustando seu pró-labore para <strong>${fmt(folhaMinima28)}/mês</strong> (+${fmt(diffFolha)}), sua empresa migra para o Anexo III e você <strong>economiza ${fmt(economiaPotencial)} todo mês (${fmt(economiaPotencial * 12)} por ano)</strong> em impostos!</p>`;
        }
    }

    btnCalc?.addEventListener('click', calcular);
    inFat?.addEventListener('input', calcular);
    inFolha?.addEventListener('input', calcular);
    selAtiv?.addEventListener('change', calcular);

    calcular();
});
</script>
@endsection
