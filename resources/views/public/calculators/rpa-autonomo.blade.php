@extends('layouts.public')
@section('title', 'Calculadora de RPA Online | Simule INSS, IRRF e ISS de Autônomo | Cotech')
@section('description', 'Calcule os descontos de INSS, Imposto de Renda (IRRF) e ISS sobre o Recibo de Pagamento a Autônomo (RPA). Compare com os impostos de emitir como PJ.')

@section('content')
<!-- BREADCRUMB -->
<div class="calc-breadcrumb-bar">
    <div class="container">
        <nav aria-label="Navegação estrutural">
            <a href="/">Início</a>
            <span class="sep">/</span>
            <a href="/calculadoras">Calculadoras</a>
            <span class="sep">/</span>
            <span class="current">Calculadora de RPA</span>
        </nav>
    </div>
</div>

<!-- HERO DA PÁGINA -->
<div class="calc-page-hero">
    <div class="container" data-reveal>
        <span class="eyebrow">SIMULADOR FISCAL PARA AUTÔNOMOS</span>
        <h1>Calculadora de RPA Online<br><span class="ink-blue">simule descontos e veja quanto sobra</span></h1>
        <p class="muted">O Recibo de Pagamento a Autônomo (RPA) sofre pesadas retenções de INSS, Imposto de Renda e ISS que podem consumir até 35% do valor do seu serviço. Calcule o valor líquido e veja a economia ao abrir um CNPJ.</p>
    </div>
</div>

<!-- SECTION CALCULADORA INTERATIVA -->
<section class="section calc-main-section">
    <div class="container">
        <div class="calc-card-grid">
            <!-- ENTRADA DE DADOS -->
            <div class="calc-inputs-card" data-reveal>
                <div class="calc-card-header">
                    <span class="calc-step-tag">DADOS DO SERVIÇO</span>
                    <h3>Simule o RPA do profissional autônomo</h3>
                    <p class="calc-subtitle">Informe o valor bruto acordado com o tomador do serviço para calcular todas as retenções tributárias na fonte.</p>
                </div>

                <div class="calc-form-group">
                    <label for="rpa-bruto">1. Valor Bruto do Serviço no RPA (R$) *</label>
                    <input type="number" id="rpa-bruto" class="calc-input" value="7000" min="500" step="100">
                    <small class="calc-field-help">Valor total combinado com o cliente antes de quaisquer deduções.</small>
                </div>

                <div class="calc-form-group">
                    <label for="rpa-dependentes">2. Número de Dependentes Legais (IRRF)</label>
                    <input type="number" id="rpa-dependentes" class="calc-input" value="0" min="0" max="10">
                    <small class="calc-field-help">Dedução de R$ 189,59 por dependente no cálculo do Imposto de Renda.</small>
                </div>

                <div class="calc-form-group">
                    <label for="rpa-iss">3. Alíquota de ISS do Município onde o serviço foi prestado</label>
                    <select id="rpa-iss" class="calc-input">
                        <option value="0.05" selected>5% (Alíquota mais comum em capitais e prestação eventual)</option>
                        <option value="0.04">4%</option>
                        <option value="0.03">3%</option>
                        <option value="0.02">2% (Alíquota mínima constitucional)</option>
                        <option value="0.00">Isento de ISS / Tomador retém 0%</option>
                    </select>
                </div>

                <div class="calc-form-group">
                    <label class="calc-checkbox-label">
                        <input type="checkbox" id="rpa-teto-inss">
                        <span>Já recolho o teto do INSS em outro trabalho formal (CLT / outro vínculo)</span>
                    </label>
                </div>

                <button type="button" class="button blue-button full-width" id="btn-calc-rpa">Calcular RPA e Descontos ↗</button>
            </div>

            <!-- RESULTADOS DO RPA -->
            <div class="calc-results-card" data-reveal>
                <span class="calc-badge-green">DEMONSTRATIVO DE RETENÇÃO</span>

                <div class="calc-result-header">
                    <small>Valor Líquido a Receber no RPA:</small>
                    <div class="calc-big-value" id="res-rpa-liquido">R$ 4.962,00</div>
                    <p class="calc-note">Total de descontos retidos na fonte: <strong id="res-rpa-total-desc">R$ 2.038,00 (29,1%)</strong></p>
                </div>

                <div class="calc-breakdown-list">
                    <div class="breakdown-item">
                        <span>Retenção INSS Autônomo (11%):</span>
                        <strong id="res-rpa-inss">- R$ 770,00</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Retenção IRPF (Tabela Receita Federal):</span>
                        <strong id="res-rpa-irrf">- R$ 918,00</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Retenção ISS Municipal:</span>
                        <strong id="res-rpa-iss">- R$ 350,00</strong>
                    </div>
                    <div class="breakdown-item highlight-saving">
                        <span>Como PJ Cotech no Simples você pagaria:</span>
                        <strong class="text-green" id="res-rpa-pj">R$ 420,00 (6%)</strong>
                    </div>
                </div>

                <!-- BANNER DE CHOQUE / ECONOMIA -->
                <div class="calc-winner-banner">
                    <span class="winner-icon">💡</span>
                    <div>
                        <strong>Você está perdendo dinheiro prestando serviço via RPA:</strong>
                        <p>Abrindo um CNPJ com a Cotech você economiza <strong class="text-green" id="res-rpa-economia">R$ 1.618,00</strong> em um único pagamento!</p>
                    </div>
                </div>

                <div class="calc-cta-box">
                    <a class="button blue-button full-width" href="/orcamento?servico=abrir-cnpj">Abrir CNPJ Grátis e Parar de Perder Dinheiro ↗</a>
                    <span class="calc-security-note">🔒 Emita notas fiscais profissionais com 6% de imposto.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SEÇÃO EDUCATIVA: O QUE É RPA -->
<section class="section calc-info-section">
    <div class="container" data-reveal>
        <span class="eyebrow">GUIA DO TRABALHADOR AUTÔNOMO</span>
        <h2>O que é o RPA e por que ele sai tão caro?</h2>
        <p class="muted">O Recibo de Pagamento a Autônomo é o documento emitido por uma empresa quando contrata um profissional autônomo (pessoa física) para prestar serviços eventuais sem vínculo empregatício:</p>

        <div class="calc-info-grid">
            <div class="calc-info-card">
                <div class="calc-info-icon">📉</div>
                <h3>Dedução Pesada de INSS (11%)</h3>
                <p>O autônomo tem 11% do valor bruto descontado diretamente na fonte para a Previdência Social, limitado ao teto do INSS (R$ 856,46 a R$ 908,00). Esse valor é retido pela empresa tomadora e repassado à Receita Federal.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🏛️</div>
                <h3>Tabela Progressiva de IRRF (até 27,5%)</h3>
                <p>Diferente de uma empresa que paga alíquotas fixas sobre o faturamento, no RPA o Imposto de Renda da Pessoa Física é retido segundo a tabela progressiva oficial, podendo alcançar a alíquota máxima de 27,5% para valores superiores a R$ 4.664.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🏢</div>
                <h3>O Custo Oculto da Empresa Contratante (20%)</h3>
                <p>Muitos não sabem, mas a empresa contratante precisa pagar mais <strong>20% de CPP (Contribuição Previdenciária Patronal)</strong> sobre o valor do RPA do autônomo. Por isso, a imensa maioria das empresas evita ao máximo emitir RPA e exige que o profissional tenha CNPJ próprio.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🚀</div>
                <h3>A Solução Definitiva: Virar PJ</h3>
                <p>Ao abrir uma microempresa (SLU) no Simples Nacional com a Cotech, você emite Nota Fiscal de Serviços com alíquota inicial de apenas 6%. Não há retenção abusiva e você passa a ser muito mais requisitado pelo mercado corporativo.</p>
            </div>
        </div>
    </div>
</section>

<!-- TABELA COMPARATIVA RPA VS PJ -->
<section class="section calc-table-section">
    <div class="container" data-reveal>
        <span class="eyebrow">COMPARAÇÃO DIRETA</span>
        <h2>Autônomo (RPA) vs Pessoa Jurídica (CNPJ)</h2>
        <p class="muted">Entenda as diferenças fiscais e operacionais entre prestar serviços como PF ou PJ:</p>

        <div class="table-wrap">
            <table class="calc-comparison-table">
                <thead>
                    <tr>
                        <th>Critério</th>
                        <th>Emitir via RPA (Pessoa Física)</th>
                        <th>Emitir via Nota Fiscal PJ (Cotech)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Impostos Totais</strong></td>
                        <td>Até 27,5% de IRPF + 11% INSS + até 5% ISS (totaliza até 35%+)</td>
                        <td><strong class="text-green">A partir de 6% no Simples Nacional (Anexo III)</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Custo para a Empresa Contratante</strong></td>
                        <td>Paga 20% de encargo patronal adicional de INSS</td>
                        <td>Custo zero adicional — apenas paga a Nota Fiscal</td>
                    </tr>
                    <tr>
                        <td><strong>Aceitação no Mercado</strong></td>
                        <td>Baixa — empresas recusam emitir RPA por ser burocrático e caro</td>
                        <td>Altíssima — padrão exigido por 99% das empresas contratantes</td>
                    </tr>
                    <tr>
                        <td><strong>Abertura de Empresa</strong></td>
                        <td>Não se aplica</td>
                        <td><strong class="text-green">100% Gratuita com a assessoria da Cotech</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- FAQ ESPECÍFICO DE RPA -->
<section class="section calc-faq-section">
    <div class="container" data-reveal>
        <span class="eyebrow">PERGUNTAS E RESPOSTAS</span>
        <h2>Dúvidas frequentes sobre Recibo de Pagamento a Autônomo</h2>

        <div class="faq-accordion-list">
            <details class="faq-item">
                <summary>Quem é o responsável por emitir e pagar a guia de impostos do RPA?</summary>
                <div class="faq-answer">
                    <p>A responsabilidade pela emissão do documento, retenção e recolhimento dos impostos (DARF de IRRF, GPS de INSS e guia de ISS) é da <strong>empresa contratante (tomadora)</strong>. O profissional autônomo já recebe o valor líquido com os descontos aplicados.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Posso emitir RPA todos os meses para o mesmo cliente?</summary>
                <div class="faq-answer">
                    <p>A emissão recorrente de RPA para o mesmo cliente por períodos prolongados configura risco severo de reconhecimento de vínculo de emprego CLT perante a Justiça do Trabalho. Para prestações de serviço continuadas, o modelo adequado e seguro é o contrato de pessoa jurídica (PJ).</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Como declarar o RPA no Imposto de Renda da Pessoa Física (IRPF)?</summary>
                <div class="faq-answer">
                    <p>A empresa tomadora deve fornecer o Informe de Rendimentos anual até o último dia útil de fevereiro. Os valores recebidos e o IRRF retido na fonte devem ser lançados na ficha de 'Rendimentos Tributáveis Recebidos de Pessoa Jurídica' na Declaração de Ajuste Anual.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Quanto tempo demora para eu abrir um CNPJ e parar de emitir RPA?</summary>
                <div class="faq-answer">
                    <p>Com a equipe da Cotech, o processo leva em média de <strong>3 a 8 dias úteis</strong>. Enquanto isso, auxiliamos você a redigir sua minuta contratual com o cliente para que seu próximo pagamento já seja faturado como PJ com 6% de imposto.</p>
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
                <span class="srv-callout-tag">ECONOMIZE SEUS GANHOS</span>
                <h2>Chega de deixar quase um terço do seu trabalho em impostos</h2>
                <p>Abra seu CNPJ com a Cotech de forma 100% gratuita nos nossos planos e comece a faturar com alíquota inicial de apenas 6%.</p>
                <div class="srv-callout-actions">
                    <a class="button blue-button" href="/orcamento?servico=abrir-cnpj">Quero Abrir Meu CNPJ Grátis <span>↗</span></a>
                    <a class="button srv-button-ghost" href="/calculadoras">Ver Outras Calculadoras <span>↗</span></a>
                </div>
            </div>
            <div class="srv-callout-image">
                <img src="/images/specialist-tablet.jpg" alt="Especialista Cotech auxiliando autônomo" width="460" height="420" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- JAVASCRIPT DO CÁLCULO DE RPA -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inBruto = document.getElementById('rpa-bruto');
    const inDep = document.getElementById('rpa-dependentes');
    const selIss = document.getElementById('rpa-iss');
    const chkTeto = document.getElementById('rpa-teto-inss');
    const btnCalc = document.getElementById('btn-calc-rpa');

    function calcular() {
        const bruto = parseFloat(inBruto.value) || 7000;
        const dep = parseInt(inDep.value) || 0;
        const issTax = parseFloat(selIss.value) || 0.05;
        const recolheTeto = chkTeto.checked;

        // INSS Autônomo: 11% limitado ao teto (aprox. 856,46 a 908)
        const tetoInssAutonomo = 856.46;
        let inss = recolheTeto ? 0 : Math.min(bruto * 0.11, tetoInssAutonomo);

        // IRPF Tabela Progressiva
        let baseIr = bruto - inss - (dep * 189.59);
        let ir = 0;
        if (baseIr <= 2259.20) {
            ir = 0;
        } else if (baseIr <= 2826.65) {
            ir = (baseIr * 0.075) - 169.44;
        } else if (baseIr <= 3751.05) {
            ir = (baseIr * 0.15) - 381.44;
        } else if (baseIr <= 4664.68) {
            ir = (baseIr * 0.225) - 662.77;
        } else {
            ir = (baseIr * 0.275) - 896.00;
        }
        ir = Math.max(0, ir);

        // ISS
        let iss = bruto * issTax;

        // Total descontos e Líquido
        let totalDescontos = inss + ir + iss;
        let liquido = bruto - totalDescontos;
        let pctDesconto = bruto > 0 ? (totalDescontos / bruto) * 100 : 0;

        // PJ no Simples Nacional a 6%
        let pjImposto = bruto * 0.06;
        let economia = totalDescontos - pjImposto;

        const fmt = val => 'R$ ' + Math.round(val).toLocaleString('pt-BR');

        document.getElementById('res-rpa-liquido').textContent = fmt(liquido);
        document.getElementById('res-rpa-total-desc').textContent = fmt(totalDescontos) + ` (${pctDesconto.toFixed(1)}%)`;
        document.getElementById('res-rpa-inss').textContent = recolheTeto ? 'R$ 0,00 (Isento por já recolher no teto)' : '- ' + fmt(inss);
        document.getElementById('res-rpa-irrf').textContent = '- ' + fmt(ir);
        document.getElementById('res-rpa-iss').textContent = issTax === 0 ? 'R$ 0,00 (Isento)' : '- ' + fmt(iss);
        document.getElementById('res-rpa-pj').textContent = fmt(pjImposto) + ' (6% no Simples)';
        document.getElementById('res-rpa-economia').textContent = fmt(Math.max(0, economia));
    }

    btnCalc?.addEventListener('click', calcular);
    inBruto?.addEventListener('input', calcular);
    inDep?.addEventListener('input', calcular);
    selIss?.addEventListener('change', calcular);
    chkTeto?.addEventListener('change', calcular);

    calcular();
});
</script>
@endsection
