@extends('layouts.public')
@section('title', 'Calculadora Fator R - Simples Nacional 2026 | Cotech Contabilidade')
@section('description', 'A calculadora Fator R ajuda você a entender se é possível economizar em impostos, de forma legal, com base no valor da folha de pagamento da sua empresa no Simples Nacional.')

@section('content')
<div class="cfr-page">
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

    <!-- 01. HERO & FORM -->
    <div class="cfr-hero-section">
        <div class="cfr-hero-container">
            <h1 class="cfr-main-title">Calculadora Fator R - Simples Nacional 2026</h1>
            <p class="cfr-lead-p">A calculadora Fator R é uma ferramenta criada para ajudar você a entender se é possível economizar em impostos, de forma legal, com base no valor da folha de pagamento da sua empresa.</p>
            <p class="cfr-sublead">Para realizar o cálculo, basta preencher os campos abaixo:</p>
        </div>

        <!-- FORM CARD -->
        <div class="cfr-card">
            <!-- FIELD 1: OPTANTE SIMPLES -->
            <div class="cfr-group">
                <label class="cfr-label">Sua empresa é optante pelo Simples Nacional?</label>
                <div class="cfr-radio-group">
                    <label class="cfr-radio-label">
                        <input type="radio" name="cfr_simples" value="sim" checked> Sim
                    </label>
                    <label class="cfr-radio-label">
                        <input type="radio" name="cfr_simples" value="nao"> Não
                    </label>
                </div>
            </div>

            <!-- FIELD 2: ATIVIDADE -->
            <div class="cfr-group">
                <label for="cfr-atividade" class="cfr-label">Qual a atividade da sua empresa?*</label>
                <select id="cfr-atividade" class="cfr-select">
                    <option value="" disabled selected>Selecione a atividade da sua empresa</option>
                    <option value="ti">Tecnologia, TI e Desenvolvimento de Software</option>
                    <option value="consultoria">Consultoria Empresarial, Finanças e Gestão</option>
                    <option value="engenharia">Engenharia, Arquitetura e Urbanismo</option>
                    <option value="saude">Medicina, Odontologia e Saúde</option>
                    <option value="psicologia">Psicologia, Terapia e Fisioterapia</option>
                    <option value="pericia">Perícia, Auditoria e Avaliações</option>
                    <option value="marketing">Marketing, Design e Criação</option>
                    <option value="outros">Outras atividades de prestação de serviços</option>
                </select>
            </div>

            <!-- FIELD 3: FATURAMENTO BRUTO -->
            <div class="cfr-group">
                <label for="cfr-faturamento" class="cfr-label">
                    Qual seu faturamento bruto mensal médio?*
                    <span class="tip" title="Receita bruta média mensal apurada nos últimos 12 meses">ⓘ</span>
                </label>
                <input type="text" id="cfr-faturamento" class="cfr-input" value="R$ 20.000,00" placeholder="R$ 0,00">
            </div>

            <!-- FIELD 4: PRO-LABORE -->
            <div class="cfr-group">
                <label class="cfr-label">Você recebe pró-labore?</label>
                <div class="cfr-radio-group">
                    <label class="cfr-radio-label">
                        <input type="radio" name="cfr_prolabore" value="sim" id="cfr-prolabore-sim"> Sim
                    </label>
                    <label class="cfr-radio-label">
                        <input type="radio" name="cfr_prolabore" value="nao" id="cfr-prolabore-nao" checked> Não
                    </label>
                </div>
                <div id="cfr-campo-prolabore" class="cfr-conditional-field">
                    <label for="cfr-val-prolabore" class="cfr-label" style="font-size: 13px;">Qual o valor mensal do pró-labore?</label>
                    <input type="text" id="cfr-val-prolabore" class="cfr-input" value="R$ 3.000,00" placeholder="R$ 0,00">
                </div>
            </div>

            <!-- FIELD 5: FUNCIONARIOS -->
            <div class="cfr-group">
                <label class="cfr-label">Você tem funcionários?</label>
                <div class="cfr-radio-group">
                    <label class="cfr-radio-label">
                        <input type="radio" name="cfr_funcionarios" value="sim" id="cfr-func-sim"> Sim
                    </label>
                    <label class="cfr-radio-label">
                        <input type="radio" name="cfr_funcionarios" value="nao" id="cfr-func-nao" checked> Não
                    </label>
                </div>
                <div id="cfr-campo-folha" class="cfr-conditional-field">
                    <label for="cfr-val-folha" class="cfr-label" style="font-size: 13px;">Qual o valor mensal da folha de salários?</label>
                    <input type="text" id="cfr-val-folha" class="cfr-input" value="R$ 3.000,00" placeholder="R$ 0,00">
                </div>
            </div>

            <div class="cfr-legal-note">
                <p style="margin: 0 0 10px;">Cálculo atualizado em 2026.</p>
                <p style="margin: 0 0 10px;">Ao utilizar esta ferramenta, você declara estar ciente de que os valores apresentados são apenas estimativas e concorda com a nossa <a href="/pagina/privacidade">Política de Privacidade</a>, Política de Cookies e Termos de Uso. A Cotech não se responsabiliza pelo uso das informações, cabendo ao usuário avaliar sua aplicação em conjunto com um contador qualificado. Para saber mais sobre os critérios utilizados nos cálculos, <a href="#consideracoes">clique aqui</a>.</p>
                <p style="margin: 0;"><strong>Importante:</strong> o Fator R é calculado a partir da média da folha de pagamento e da receita bruta dos últimos 12 meses. Se sua empresa tem menos de 12 meses, os dados podem ser insuficientes.</p>
            </div>

            <button type="button" id="cfr-btn-submit" class="cfr-btn-calc">CALCULAR FATOR R</button>

            <!-- DYNAMIC RESULT BOX -->
            <div id="cfr-result-box" class="cfr-result-box">
                <div id="cfr-res-badge" class="cfr-res-badge anexo-3">Anexo III (6%)</div>
                <div id="cfr-res-score" class="cfr-res-score">30.0%</div>
                <p id="cfr-res-desc" class="cfr-res-desc">Parabéns! Sua folha representa mais de 28% do faturamento. Sua empresa tem direito a pagar a alíquota reduzida de 6% no Simples Nacional.</p>
                <div id="cfr-res-saving-box" style="background: #f8fafc; border-radius: 6px; padding: 12px 14px; margin-bottom: 16px; font-size: 13.5px; color: #002b49;">
                    <span>Economia mensal estimada em impostos:</span>
                    <strong id="cfr-res-saving" style="color: #059669; display: block; font-size: 17px; margin-top: 4px;">R$ 1.900,00 /mês</strong>
                </div>
                <a id="cfr-cta-link" href="/orcamento?servico=fator-r" class="cfr-res-cta">Quero Otimizar meus Impostos com a Cotech ↗</a>
            </div>
        </div>
    </div>

    <!-- 02. TWO-TONE BANNER SECTION (PRINT 2) -->
    <section class="cfr-section-banner" id="consideracoes">
        <div class="cfr-banner-decor-circle" aria-hidden="true"></div>
        <div class="cfr-banner-grid">
            <div class="cfr-banner-left">
                <span class="cfr-banner-eyebrow">FATOR R</span>
                <h2>Considerações importantes sobre a calculadora de Fator R</h2>
            </div>
            <div class="cfr-banner-right-box">
                <p>O uso do Fator R é uma forma legal de pagar menos impostos, sendo considerado um instrumento de elisão fiscal. O cálculo Fator R se aplica apenas às empresas optantes pelo Simples Nacional e em determinadas atividades empresariais (verificar parágrafo abaixo).</p>
                <p>Para calcular o Fator R, preencha os campos da calculadora para distinção entre atividades permitidas e não permitidas, assim como para a verificação se a empresa faz parte do Simples Nacional.</p>
            </div>
        </div>
    </section>

    <!-- 03. DETAILED CONTENT (PRINT 2 & 3) -->
    <div class="cfr-section-content">
        <!-- O QUE É O FATOR R -->
        <div class="cfr-content-block">
            <h2>O que é o Fator R</h2>
            <p>O Fator R é um cálculo que determina em qual anexo do Simples Nacional sua empresa de serviços será tributada. Ele representa a proporção entre a sua folha de pagamento e sua receita bruta, considerando sempre o acumulado dos últimos 12 meses.</p>
            <p>O resultado desse cálculo define se sua empresa pagará impostos pelas alíquotas do <strong>Anexo V</strong> (geralmente mais altas) ou do <strong>Anexo III</strong> (mais baixas e vantajosas).</p>
            
            <p>O Fator R funciona assim:</p>
            <ul>
                <li>Se a sua folha de pagamento for <strong>igual ou superior a 28%</strong> do seu faturamento bruto, sua empresa é tributada pelo <strong>Anexo III</strong>, com alíquotas a partir de <strong>6%</strong>.</li>
                <li>Se a sua folha de pagamento for <strong>inferior a 28%</strong> do faturamento, a tributação ocorre pelo <strong>Anexo V</strong>, com alíquotas a partir de <strong>15,5%</strong>.</li>
            </ul>

            <p>É importante destacar que o cálculo do Fator R é feito mensalmente, utilizando o período acumulado dos últimos 12 meses. Por isso, o enquadramento da sua empresa pode mudar de um mês para o outro.</p>
            <p>Confira com os contadores da Cotech como ajustar legalmente o seu pró-labore para garantir que sua empresa permaneça sempre na faixa mais econômica de 6% do Simples Nacional.</p>
        </div>

        <!-- COMO CALCULAR O FATOR R -->
        <div class="cfr-content-block">
            <h2>Como calcular o Fator R do Simples Nacional?</h2>
            <p>Para calcular o Fator R, utiliza-se a seguinte fórmula:</p>

            <div class="cfr-formula-box">
                Fator R = Total de gastos com folha de pagamento acumulado nos últimos 12 meses ÷ receita bruta acumulada nos últimos 12 meses.
            </div>

            <h3>O que compõe cada parte da fórmula?</h3>
            <ul>
                <li><strong>Gastos com folha de pagamento acumulada:</strong> é a soma de todos os valores pagos a título de remuneração nos últimos 12 meses. Isso inclui: salários de funcionários, pró-labore dos sócios, pagamentos de autônomos, e os encargos sobre esses valores, como o INSS e o FGTS.</li>
                <li><strong>Receita Bruta (RBT12):</strong> é o valor total das vendas de produtos e/ou serviços da sua empresa nos últimos 12 meses, sem a dedução de custos ou impostos.</li>
            </ul>

            <div class="cfr-example-card">
                <h3 style="margin-top: 0;">Exemplo prático:</h3>
                <p>Imagine que a receita bruta acumulada da sua empresa nos últimos 12 meses foi de <strong>R$ 120.000,00</strong>. No mesmo período, a soma de todos os gastos com folha de pagamento (salários + pró-labore + encargos) foi de <strong>R$ 42.000,00</strong>.</p>
                
                <p><strong>Cálculo:</strong></p>
                <ul>
                    <li>Fator R = R$ 42.000,00 / R$ 120.000,00</li>
                    <li>Fator R = 0,35</li>
                </ul>

                <p><strong>Conversão para percentual:</strong></p>
                <ul>
                    <li>0,35 * 100 = <strong>35%</strong></li>
                </ul>

                <p><strong>Resultado:</strong> Como o Fator R de 35% é superior a 28%, a empresa será tributada pelo <strong>Anexo III do Simples Nacional</strong>, garantindo uma alíquota de imposto a partir de 6% em vez de 15,5%.</p>
            </div>

            <h3>Considerações importantes:</h3>
            <ul>
                <li><strong>Planejamento Tributário Legal:</strong> utilizar o Fator R para ajustar o pró-labore e se enquadrar no Anexo III é uma estratégia de <strong>elisão fiscal</strong>. Trata-se de uma prática 100% legal que usa as regras da própria legislação para reduzir a carga de impostos da sua empresa.</li>
                <li><strong>Regime Tributário:</strong> o Fator R aplica-se exclusivamente para empresas do Simples Nacional.</li>
                <li><strong>Atividades Aplicáveis:</strong> o cálculo é relevante para empresas que exercem atividades de natureza intelectual, técnica, científica, cultural, entre outras, que são tributadas com base na relação entre os Anexos III e V. Alguns exemplos são: Arquitetura e Urbanismo, Fisioterapia, Medicina, Odontologia, Psicologia, Engenharia, Desenvolvimento de Software e Tecnologia da Informação, Consultoria Empresarial, Perícia e Auditoria.</li>
            </ul>
        </div>

        <!-- CTA FINAL COTECH -->
        <div style="background: #002b49; color: #ffffff; border-radius: 12px; padding: 36px 32px; text-align: center; margin-top: 30px;">
            <h3 style="color: #ffffff; font-size: 24px; margin: 0 0 10px;">Quer reduzir os impostos da sua empresa com segurança?</h3>
            <p style="color: #cbd5e1; font-size: 15px; margin: 0 0 24px; max-width: 600px; margin-left: auto; margin-right: auto;">Nossos contadores analisam seu faturamento e folha sem compromisso para você usufruir da alíquota mínima de 6% no Simples Nacional.</p>
            <a href="/orcamento?servico=fator-r" class="cbr-btn-cyan">Falar com nossos Contadores Especialistas ↗</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputFat = document.getElementById('cfr-faturamento');
    const inputProlabore = document.getElementById('cfr-val-prolabore');
    const inputFolha = document.getElementById('cfr-val-folha');
    const radioProlaboreSim = document.getElementById('cfr-prolabore-sim');
    const radioProlaboreNao = document.getElementById('cfr-prolabore-nao');
    const campoProlabore = document.getElementById('cfr-campo-prolabore');
    const radioFuncSim = document.getElementById('cfr-func-sim');
    const radioFuncNao = document.getElementById('cfr-func-nao');
    const campoFolha = document.getElementById('cfr-campo-folha');
    const btnCalc = document.getElementById('cfr-btn-submit');
    const resultBox = document.getElementById('cfr-result-box');

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

    [inputFat, inputProlabore, inputFolha].forEach(setupMoneyInput);

    radioProlaboreSim?.addEventListener('change', function() {
        if (this.checked) campoProlabore.classList.add('show');
    });
    radioProlaboreNao?.addEventListener('change', function() {
        if (this.checked) campoProlabore.classList.remove('show');
    });

    radioFuncSim?.addEventListener('change', function() {
        if (this.checked) campoFolha.classList.add('show');
    });
    radioFuncNao?.addEventListener('change', function() {
        if (this.checked) campoFolha.classList.remove('show');
    });

    function calcular() {
        const fat = parseMoney(inputFat.value) || 20000;
        let folhaTotal = 0;
        if (radioProlaboreSim.checked) {
            folhaTotal += parseMoney(inputProlabore.value);
        }
        if (radioFuncSim.checked) {
            folhaTotal += parseMoney(inputFolha.value);
        }

        // Se o usuário não marcou nenhum, consideramos folha atual 0 para simulação educativa
        const fator = fat > 0 ? (folhaTotal / fat) : 0;
        const percentual = (fator * 100);

        const badgeEl = document.getElementById('cfr-res-badge');
        const scoreEl = document.getElementById('cfr-res-score');
        const descEl = document.getElementById('cfr-res-desc');
        const savingEl = document.getElementById('cfr-res-saving');
        const ctaLink = document.getElementById('cfr-cta-link');

        scoreEl.textContent = percentual.toFixed(1) + '%';

        if (percentual >= 28) {
            badgeEl.className = 'cfr-res-badge anexo-3';
            badgeEl.textContent = 'Enquadrada no Anexo III (6%) 🎉';
            descEl.innerHTML = `Sua proporção folha/faturamento atingiu <strong>${percentual.toFixed(1)}%</strong> (superior ao limite de 28%). Sua empresa pagará a menor alíquota inicial do Simples Nacional de apenas <strong>6%</strong>.`;
            const economia = fat * (0.155 - 0.06);
            savingEl.textContent = fmt(economia) + ' /mês (' + fmt(economia * 12) + '/ano)';
        } else {
            badgeEl.className = 'cfr-res-badge anexo-5';
            badgeEl.textContent = 'Enquadrada no Anexo V (15,5%) ⚠️';
            const folhaNecessaria = fat * 0.28;
            const falta = folhaNecessaria - folhaTotal;
            descEl.innerHTML = `Seu Fator R atual é de <strong>${percentual.toFixed(1)}%</strong> (inferior a 28%). Ajustando seu pró-labore para <strong>${fmt(folhaNecessaria)}</strong>/mês (adicionando ${fmt(falta)}), sua empresa migra para o Anexo III pagando 6% em vez de 15,5%!`;
            const economia = fat * (0.155 - 0.06);
            savingEl.textContent = 'Potencial de economizar ' + fmt(economia) + ' /mês!';
        }

        if (ctaLink) {
            ctaLink.href = `/orcamento?servico=fator-r&faturamento=${encodeURIComponent(fat)}&fator=${encodeURIComponent(percentual.toFixed(1))}`;
        }

        resultBox.classList.add('show');
        resultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    btnCalc?.addEventListener('click', calcular);
});
</script>
@endsection
