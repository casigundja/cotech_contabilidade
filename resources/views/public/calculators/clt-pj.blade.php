@extends('layouts.public')
@section('title', 'Calculadora salário PJ x CLT | Cotech Contabilidade')
@section('description', 'Compare de forma simples os impostos, benefícios e contribuições entre PJ e CLT. Calcule quanto você precisa ganhar como PJ para manter seus ganhos equilibrados.')

@section('content')
<div class="cpj-page">
    <!-- BREADCRUMB -->
    <div class="cpj-breadcrumb-bar">
        <div class="container">
            <nav class="cbr-breadcrumb" aria-label="Navegação estrutural">
                <a href="/">Materiais</a>
                <span class="sep">></span>
                <span class="current">Calculadora</span>
            </nav>
        </div>
    </div>

    <!-- 01. HERO SECTION -->
    <div class="cpj-hero-section">
        <div class="container">
            <div class="cpj-hero-card">
                <div class="cpj-hero-content">
                    <h1>Calculadora salário PJ x CLT<span class="dot-cyan">.</span></h1>
                    <p>A calculadora PJ x CLT é uma ferramenta que compara de forma simples os impostos, benefícios e contribuições de cada regime, ajudando você a entender quanto precisaria ganhar como PJ para manter os ganhos equilibrados. Além disso, a ferramenta também calcula o salário líquido em cada regime, mostrando claramente as diferenças e ajudando você a tomar decisões financeiras mais assertivas.</p>
                </div>
                <div class="cpj-hero-image">
                    <img src="/images/hero-clt-pj-woman.jpg" alt="Profissional avaliando proposta PJ x CLT" width="320" height="240">
                </div>
            </div>

            <!-- FORM CARD -->
            <div class="cpj-form-card">
                <div class="cpj-form-title">Preencha as informações abaixo com seus dados CLT:</div>

                <div class="cpj-form-grid-3">
                    <div class="cpj-field">
                        <label for="cpj-salario">Salário mensal bruto:</label>
                        <input type="text" id="cpj-salario" class="cpj-input" value="R$ 6.000,00" placeholder="R$ 0,00">
                    </div>
                    <div class="cpj-field">
                        <label for="cpj-vr">Vale-refeição/alimentação (opcional):</label>
                        <input type="text" id="cpj-vr" class="cpj-input" value="R$ 800,00" placeholder="R$ 0,00">
                    </div>
                    <div class="cpj-field">
                        <label for="cpj-vt">Vale-transporte (opcional):</label>
                        <input type="text" id="cpj-vt" class="cpj-input" value="R$ 0,00" placeholder="R$ 0,00">
                    </div>
                </div>

                <div class="cpj-form-grid-2">
                    <div class="cpj-field">
                        <label for="cpj-saude">Plano de saúde (opcional):</label>
                        <input type="text" id="cpj-saude" class="cpj-input" value="R$ 450,00" placeholder="R$ 0,00">
                    </div>
                    <div class="cpj-field">
                        <label for="cpj-outros">
                            Outros benefícios (opcional):
                            <span class="tip" title="Previdência privada, auxílio creche, seguro de vida, etc.">ⓘ</span>
                        </label>
                        <input type="text" id="cpj-outros" class="cpj-input" value="R$ 0,00" placeholder="R$ 0,00">
                    </div>
                </div>

                <div class="cpj-form-footer">
                    <p class="cpj-form-note">
                        Cálculo atualizado em 2026.<br>
                        Ao utilizar esta ferramenta, você declara estar ciente de que os valores apresentados são apenas estimativas e concorda com a nossa <a href="/pagina/privacidade">Política de Privacidade</a>, Política de Cookies e Termos de Uso. Para saber mais sobre os critérios utilizados nos cálculos, <a href="#como-calcular">clique aqui</a>.
                    </p>
                    <button type="button" id="cpj-btn-calc" class="cpj-btn-result">VER RESULTADO</button>
                </div>

                <!-- DYNAMIC RESULTS PANEL -->
                <div id="cpj-results-card" class="cpj-results-card">
                    <div class="cpj-results-head">
                        <div>
                            <h3>Resultado Comparativo PJ x CLT</h3>
                            <small class="muted">Estimativa personalizada com base nos seus dados informados</small>
                        </div>
                    </div>

                    <div class="cpj-sugestao-banner">
                        <div>
                            <span>Faturamento PJ mensal sugerido para ter o mesmo padrão de vida:</span>
                            <p style="margin: 4px 0 0; font-size: 13px; color: #cbd5e1;">Compensa todos os benefícios, 13º, férias e impostos do Simples Nacional.</p>
                        </div>
                        <strong id="res-pj-sugerido">R$ 9.150,00</strong>
                    </div>

                    <div class="cpj-compare-grid">
                        <!-- CLT BOX -->
                        <div class="cpj-box">
                            <span class="cpj-box-tag tag-clt">Cenário CLT Atual</span>
                            <div class="cpj-big-num" id="res-clt-liquido">R$ 4.890,00</div>
                            <small class="muted">Salário líquido mensal direto na conta</small>

                            <ul class="cpj-row-list">
                                <li><span>Salário Bruto:</span> <strong id="res-clt-bruto">R$ 6.000,00</strong></li>
                                <li><span>Desconto INSS estimado:</span> <span id="res-clt-inss" class="text-danger">- R$ 680,00</span></li>
                                <li><span>Desconto IRRF estimado:</span> <span id="res-clt-irrf" class="text-danger">- R$ 430,00</span></li>
                                <li><span>Benefícios mensais somados:</span> <strong id="res-clt-beneficios">+ R$ 1.250,00</strong></li>
                                <li><span>Provisão FGTS (8%):</span> <strong id="res-clt-fgts">+ R$ 480,00</strong></li>
                                <li><span>Provisão 13º + Férias (+⅓):</span> <strong id="res-clt-decimo">+ R$ 850,00</strong></li>
                                <li style="border-top: 1px dashed #cbd5e1; padding-top: 8px; font-weight: 700;">
                                    <span>Remuneração Total Real CLT:</span>
                                    <strong id="res-clt-total-real">R$ 7.470,00</strong>
                                </li>
                            </ul>
                        </div>

                        <!-- PJ BOX -->
                        <div class="cpj-box highlight">
                            <span class="cpj-box-tag tag-pj">Cenário PJ Recomendado</span>
                            <div class="cpj-big-num text-green" id="res-pj-liquido">R$ 8.240,00</div>
                            <small class="muted">Líquido estimado livre de impostos na sua conta</small>

                            <ul class="cpj-row-list">
                                <li><span>Faturamento Bruto Emitido:</span> <strong id="res-pj-bruto">R$ 9.150,00</strong></li>
                                <li><span>Imposto Simples Nacional (6% Fator R):</span> <span id="res-pj-imposto" class="text-danger">- R$ 549,00</span></li>
                                <li><span>INSS Pró-labore (11% s/ salário mín.):</span> <span id="res-pj-inss" class="text-danger">- R$ 167,00</span></li>
                                <li><span>Contabilidade Cotech Completa:</span> <span class="text-danger">- R$ 195,00</span></li>
                                <li><span>Honorários de Abertura:</span> <strong class="text-green">R$ 0,00 (GRÁTIS)</strong></li>
                                <li style="border-top: 1px dashed #a7f3d0; padding-top: 8px; font-weight: 700; color: #065f46;">
                                    <span>Ganho Líquido Extra no Bolso:</span>
                                    <strong id="res-pj-vantagem" style="color: #059669;">+ R$ 770,00 /mês</strong>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div style="text-align: center; margin-top: 20px;">
                        <a id="cpj-cta-link" href="/orcamento?servico=transicao-pj" class="cbr-btn-cyan">Falar com Consultor Contábil e Abrir CNPJ Grátis ↗</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 02. SECTION: COMO CALCULAR O SALÁRIO PJ -->
    <section class="cpj-section-howto" id="como-calcular">
        <div class="container">
            <div class="cpj-howto-grid">
                <div class="cpj-howto-content">
                    <h2>Como calcular o salário PJ<span class="dot-cyan">.</span></h2>
                    
                    <p>Para calcular o salário PJ é necessário entender primeiro como calcular o seu salário líquido CLT, somando os benefícios típicos dessa modalidade. O cálculo do salário CLT envolve os seguintes passos:</p>

                    <ol class="cpj-steps-ol">
                        <li><strong>Salário líquido CLT:</strong> considere o seu salário líquido mensal (já descontados os impostos);</li>
                        <li><strong>Férias + ⅓:</strong> adicione 33,33% sobre o valor do salário bruto, e, sobre este valor, desconte os impostos incidentes (INSS e IRRF) para encontrar o valor líquido. Por fim, divida o resultado por 12 e adicione esse valor ao salário líquido;</li>
                        <li><strong>13º salário:</strong> divida o seu salário líquido mensal por 12 e adicione esse valor à soma;</li>
                        <li><strong>FGTS:</strong> adicione 8% sobre o valor do salário bruto (relacionado ao FGTS);</li>
                        <li><strong>Benefícios:</strong> some os benefícios de alimentação, saúde e outros pagos pela empresa.</li>
                    </ol>

                    <p>Após calcular o salário CLT, você poderá comparar com o salário PJ. Para calcular o salário líquido PJ, siga os seguintes passos:</p>

                    <ol class="cpj-steps-ol">
                        <li><strong>Imposto da empresa:</strong> desconte de 6% a 33% do faturamento da empresa (dependendo do regime tributário);</li>
                        <li><strong>INSS:</strong> desconte 11% sobre o valor do pró-labore (salário definido para fins de contribuição);</li>
                        <li><strong>Contabilidade:</strong> desconte o custo mensal com contabilidade, que varia conforme o contador e os serviços prestados.</li>
                    </ol>

                    <p>Na prática, para que a remuneração de um PJ seja equivalente ao que você receberia como CLT é necessário que o <strong>salário bruto PJ seja, em média, de 20% a 50% maior do que o salário bruto CLT</strong>. Isso ocorre porque, como PJ, você arca com os impostos e encargos que no CLT são de responsabilidade do empregador. Além de, em geral, perder benefícios como vale-alimentação e plano de saúde, normalmente concedidos a trabalhadores CLT.</p>
                </div>

                <div class="cpj-howto-visual">
                    <img src="/images/calculadora-mao-clt.jpg" alt="Mão segurando calculadora azul com valor 15000" width="360" height="360" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- 03. SECTION: CARDS PJ VS CLT -->
    <section class="cpj-section-cards">
        <div class="container">
            <div class="cpj-cards-compare-grid">
                <!-- CARD PJ -->
                <div class="cpj-compare-card card-pj">
                    <span class="cpj-badge-pill pill-pj">PJ</span>
                    <p>No regime PJ (pessoa jurídica), o trabalhador firma um contrato de prestação de serviços com a empresa, sem vínculo empregatício formal. As características deste modelo incluem:</p>
                    
                    <ul class="cpj-bullet-list">
                        <li>
                            <span class="chk">✓</span>
                            <span><strong>Remuneração sem descontos:</strong> o salário é pago integralmente, mas o PJ é responsável por pagar seus próprios impostos, que variam conforme o porte da empresa, faturamento e atividade exercida. Por exemplo: Simples Nacional, Lucro Presumido ou Lucro Real.</span>
                        </li>
                        <li>
                            <span class="chk">✓</span>
                            <span><strong>Direitos trabalhistas:</strong> o PJ não possui os benefícios trabalhistas garantidos pela CLT, como férias, 13º salário ou FGTS, a menos que sejam acordados de forma contratual.</span>
                        </li>
                        <li>
                            <span class="chk">✓</span>
                            <span><strong>Flexibilidade de horário:</strong> O PJ pode estipular sua própria agenda de trabalho, desde que cumpra as obrigações acordadas com o contratante.</span>
                        </li>
                        <li>
                            <span class="chk">✓</span>
                            <span><strong>Maior liberdade:</strong> O PJ pode prestar serviços para diversos empregadores ao mesmo tempo, sem a limitação de um vínculo exclusivo.</span>
                        </li>
                    </ul>
                </div>

                <!-- CARD CLT -->
                <div class="cpj-compare-card card-clt">
                    <span class="cpj-badge-pill pill-clt">CLT</span>
                    <p>Na contratação CLT, o vínculo empregatício é formalizado com a assinatura na carteira de trabalho, garantindo ao empregado diversos benefícios trabalhistas como:</p>
                    
                    <ul class="cpj-bullet-list">
                        <li>
                            <span class="chk">✓</span>
                            <span><strong>Férias, 13º salário, FGTS, vale-transporte e vale-refeição</strong> (dependendo do contrato).</span>
                        </li>
                        <li>
                            <span class="chk">✓</span>
                            <span>O salário de um empregado CLT já sofre <strong>descontos obrigatórios, como o INSS e o Imposto de Renda (IRRF)</strong>, o que reduz o valor líquido recebido mensalmente.</span>
                        </li>
                        <li>
                            <span class="chk">✓</span>
                            <span>O empregado CLT precisa cumprir a <strong>jornada de trabalho estabelecida por lei</strong>.</span>
                        </li>
                        <li>
                            <span class="chk">✓</span>
                            <span>O regime CLT oferece <strong>mais segurança e direitos trabalhistas</strong>, mas a remuneração líquida é afetada pelos descontos obrigatórios e pela limitação de flexibilidade.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- 05. SECTION: OUTRAS INFORMAÇÕES IMPORTANTES (TABS) -->
    <section class="cpj-section-tabs">
        <div class="container">
            <h2 class="cbr-section-title">Outras informações importantes<span class="dot-cyan">.</span></h2>

            <!-- TABS NAVIGATION -->
            <div class="cpj-tabs-nav" role="tablist">
                <button type="button" class="cpj-tab-btn active" data-tab="tab-contratacao">📄 Contratação</button>
                <button type="button" class="cpj-tab-btn" data-tab="tab-obrigacoes">📋 Obrigações</button>
                <button type="button" class="cpj-tab-btn" data-tab="tab-direitos">⚖️ Direitos</button>
                <button type="button" class="cpj-tab-btn" data-tab="tab-descontos">🏷️ Descontos</button>
            </div>

            <!-- TAB 1: CONTRATAÇÃO -->
            <div id="tab-contratacao" class="cpj-tab-content-box active">
                <h3>Como é feita a contratação PJ e CLT?</h3>
                <div class="cpj-tab-two-cols">
                    <div>
                        <span class="cpj-badge-pill pill-pj">PJ</span>
                        <p>A contratação PJ é bem diferente da contratação CLT, pois não há vínculo empregatício formal e as obrigações trabalhistas são distintas. Veja como funciona:</p>
                        <ul class="cpj-bullet-list">
                            <li><span class="chk">✓</span> <span><strong>Abrir uma empresa:</strong> para ser contratado como PJ, o profissional precisa abrir uma empresa (CNPJ) e atuar como prestador de serviços.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Contrato de prestação de serviços:</strong> a relação entre o PJ e a empresa contratante é formalizada por meio de um contrato de prestação de serviços, no qual são definidos detalhes como horário de trabalho, quantidade de horas, escopo e remuneração.</span></li>
                        </ul>
                    </div>
                    <div>
                        <span class="cpj-badge-pill pill-clt">CLT</span>
                        <p>A contratação CLT segue uma série de normas celetistas e envolve um processo mais formal, com custos e obrigações tanto para o empregado quanto para o empregador. Veja os principais pontos:</p>
                        <ul class="cpj-bullet-list">
                            <li><span class="chk">✓</span> <span><strong>Vínculo empregatício:</strong> o profissional que é contratado CLT tem um vínculo formal com a empresa, com registro na carteira de trabalho e garantias de direitos trabalhistas.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Documentação e procedimentos:</strong> para formalizar a contratação, o empregador deve seguir alguns procedimentos legais, como a assinatura da carteira de trabalho e exames médicos admissionais.</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- TAB 2: OBRIGAÇÕES -->
            <div id="tab-obrigacoes" class="cpj-tab-content-box">
                <h3>Quais são as principais obrigações?</h3>
                <div class="cpj-tab-two-cols">
                    <div>
                        <span class="cpj-badge-pill pill-pj">PJ</span>
                        <p>No modelo PJ, o profissional é responsável por gerenciar a própria empresa:</p>
                        <ul class="cpj-bullet-list">
                            <li><span class="chk">✓</span> <span><strong>Emissão de Notas Fiscais:</strong> Emitir nota fiscal para receber seus honorários acordados no contrato.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Pagamento de Impostos (DAS):</strong> Recolher a guia do Simples Nacional mensalmente (a partir de 6% com Fator R).</span></li>
                            <li><span class="chk">✓</span> <span><strong>Contabilidade Ativa:</strong> Manter uma contabilidade regular para entrega de obrigações e distribuição de lucros 100% isenta.</span></li>
                        </ul>
                    </div>
                    <div>
                        <span class="cpj-badge-pill pill-clt">CLT</span>
                        <p>No modelo CLT, as obrigações fiscais são retidas diretamente pela empresa empregadora:</p>
                        <ul class="cpj-bullet-list">
                            <li><span class="chk">✓</span> <span><strong>Cumprimento de Jornada:</strong> Bater ponto e respeitar os horários estipulados na jornada de 44h semanais.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Subordinação Direta:</strong> Submeter-se à hierarquia e normas internas estabelecidas pelo empregador.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Declaração de Ajuste Anual:</strong> Declarar o imposto de renda pessoa física anual com base no informe de rendimentos.</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- TAB 3: DIREITOS -->
            <div id="tab-direitos" class="cpj-tab-content-box">
                <h3>Direitos e Benefícios comparados</h3>
                <div class="cpj-tab-two-cols">
                    <div>
                        <span class="cpj-badge-pill pill-pj">PJ</span>
                        <p>O profissional PJ tem liberdade de negociação direta com a empresa:</p>
                        <ul class="cpj-bullet-list">
                            <li><span class="chk">✓</span> <span><strong>Remuneração sem teto:</strong> Possibilidade de negociar livremente valores e reajustes sem convenção coletiva.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Múltiplos Clientes:</strong> Liberdade para prestar serviços a várias empresas simultaneamente e acelerar seus ganhos.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Recessos Negociados:</strong> Dias de descanso e bonificações podem ser livremente pactuados no contrato de serviços.</span></li>
                        </ul>
                    </div>
                    <div>
                        <span class="cpj-badge-pill pill-clt">CLT</span>
                        <p>O trabalhador CLT conta com a rede de proteção da legislação trabalhista:</p>
                        <ul class="cpj-bullet-list">
                            <li><span class="chk">✓</span> <span><strong>13º Salário e Férias Remuneradas:</strong> 30 dias de férias após 12 meses de trabalho com adicional de ⅓ constitucional.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Fundo de Garantia (FGTS):</strong> Depósito mensal de 8% do salário em conta vinculada na Caixa com multa rescisória de 40%.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Seguro-Desemprego:</strong> Proteção financeira temporária em caso de demissão sem justa causa.</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- TAB 4: DESCONTOS -->
            <div id="tab-descontos" class="cpj-tab-content-box">
                <h3>Descontos e Tributação: PJ x CLT</h3>
                <div class="cpj-tab-two-cols">
                    <div>
                        <span class="cpj-badge-pill pill-pj">PJ</span>
                        <p>A tributação PJ é muito mais favorável para serviços intelectuais:</p>
                        <ul class="cpj-bullet-list">
                            <li><span class="chk">✓</span> <span><strong>Simples Nacional:</strong> Alíquota a partir de 6% sobre a nota fiscal emitida no Anexo III.</span></li>
                            <li><span class="chk">✓</span> <span><strong>INSS Mínimo:</strong> 11% sobre o salário mínimo de pró-labore para manter cobertura previdenciária.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Sem IRRF na Distribuição:</strong> Lucro transferido para a pessoa física é 100% isento de imposto de renda.</span></li>
                        </ul>
                    </div>
                    <div>
                        <span class="cpj-badge-pill pill-clt">CLT</span>
                        <p>Na CLT os descontos são compulsórios e pesados no contracheque:</p>
                        <ul class="cpj-bullet-list">
                            <li><span class="chk">✓</span> <span><strong>INSS Progressivo:</strong> Desconto de 7,5% a 14% retido na fonte todo mês.</span></li>
                            <li><span class="chk">✓</span> <span><strong>IRRF na Fonte:</strong> Alíquotas de até 27,5% descontadas diretamente do seu salário.</span></li>
                            <li><span class="chk">✓</span> <span><strong>Coparticipações:</strong> Descontos de até 6% para vale-transporte e cotas de plano de saúde.</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- BOTTOM BANNERS -->
            <div class="cpj-bottom-banners">
                <div class="cpj-banner-card">
                    <span>Conheça nosso serviço de abertura de empresa</span>
                    <a href="/calculadora-de-custo-para-tirar-cnpj" class="cpj-banner-btn btn-outline">SAIBA MAIS</a>
                </div>
                <div class="cpj-banner-card">
                    <span>Dúvidas? Fale com nosso time de atendimento</span>
                    <a href="/orcamento" class="cpj-banner-btn btn-cyan">FALAR COM ESPECIALISTA</a>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputSalario = document.getElementById('cpj-salario');
    const inputVr = document.getElementById('cpj-vr');
    const inputVt = document.getElementById('cpj-vt');
    const inputSaude = document.getElementById('cpj-saude');
    const inputOutros = document.getElementById('cpj-outros');
    const btnCalc = document.getElementById('cpj-btn-calc');
    const resultsCard = document.getElementById('cpj-results-card');

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

    [inputSalario, inputVr, inputVt, inputSaude, inputOutros].forEach(setupMoneyInput);

    function calcInssClt(salario) {
        if (salario <= 1412.00) return salario * 0.075;
        if (salario <= 2666.68) return 1412.00 * 0.075 + (salario - 1412.00) * 0.09;
        if (salario <= 4000.03) return 1412.00 * 0.075 + (2666.68 - 1412.00) * 0.09 + (salario - 2666.68) * 0.12;
        if (salario <= 7786.02) return 1412.00 * 0.075 + (2666.68 - 1412.00) * 0.09 + (4000.03 - 2666.68) * 0.12 + (salario - 4000.03) * 0.14;
        return 908.86;
    }

    function calcIrrfClt(base) {
        if (base <= 2259.20) return 0;
        if (base <= 2826.65) return base * 0.075 - 169.44;
        if (base <= 3751.05) return base * 0.15 - 381.44;
        if (base <= 4664.68) return base * 0.225 - 662.77;
        return base * 0.275 - 896.00;
    }

    function calcular() {
        const brutoClt = parseMoney(inputSalario.value) || 6000;
        const vr = parseMoney(inputVr.value) || 0;
        const vt = parseMoney(inputVt.value) || 0;
        const saude = parseMoney(inputSaude.value) || 0;
        const outros = parseMoney(inputOutros.value) || 0;

        const totalBeneficios = vr + vt + saude + outros;
        const inssClt = calcInssClt(brutoClt);
        const irrfClt = Math.max(0, calcIrrfClt(brutoClt - inssClt));
        const liquidoClt = brutoClt - inssClt - irrfClt;

        const fgts = brutoClt * 0.08;
        const decimoProporcional = liquidoClt / 12;
        const feriasProporcional = (brutoClt * 1.3333 - inssClt - irrfClt) / 12;
        const totalRealClt = liquidoClt + totalBeneficios + fgts + decimoProporcional + feriasProporcional;

        // Faturamento PJ recomendado: aproximadamente 30% a mais que o total real CLT para superar custos e gerar economia
        const aliquotaSimples = 0.06;
        const custoContabilidade = 195.00;
        const inssProLabore = 167.00;
        const pjSugerido = Math.round((totalRealClt + custoContabilidade + inssProLabore) / (1 - aliquotaSimples));
        const impostoPj = pjSugerido * aliquotaSimples;
        const liquidoPj = pjSugerido - impostoPj - inssProLabore - custoContabilidade;
        const vantagem = liquidoPj - totalRealClt;

        document.getElementById('res-clt-bruto').textContent = fmt(brutoClt);
        document.getElementById('res-clt-inss').textContent = '- ' + fmt(inssClt);
        document.getElementById('res-clt-irrf').textContent = '- ' + fmt(irrfClt);
        document.getElementById('res-clt-liquido').textContent = fmt(liquidoClt);
        document.getElementById('res-clt-beneficios').textContent = '+ ' + fmt(totalBeneficios);
        document.getElementById('res-clt-fgts').textContent = '+ ' + fmt(fgts);
        document.getElementById('res-clt-decimo').textContent = '+ ' + fmt(decimoProporcional + feriasProporcional);
        document.getElementById('res-clt-total-real').textContent = fmt(totalRealClt);

        document.getElementById('res-pj-sugerido').textContent = fmt(pjSugerido);
        document.getElementById('res-pj-bruto').textContent = fmt(pjSugerido);
        document.getElementById('res-pj-imposto').textContent = '- ' + fmt(impostoPj);
        document.getElementById('res-pj-inss').textContent = '- ' + fmt(inssProLabore);
        document.getElementById('res-pj-liquido').textContent = fmt(liquidoPj);
        document.getElementById('res-pj-vantagem').textContent = (vantagem >= 0 ? '+ ' : '') + fmt(vantagem) + ' /mês';

        const ctaLink = document.getElementById('cpj-cta-link');
        if (ctaLink) {
            ctaLink.href = `/orcamento?servico=transicao-pj&salario=${encodeURIComponent(brutoClt)}&pj_sugerido=${encodeURIComponent(pjSugerido)}`;
        }

        if (resultsCard) {
            resultsCard.classList.add('show');
            resultsCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    btnCalc?.addEventListener('click', calcular);

    // TABS SWITCHER
    const tabBtns = document.querySelectorAll('.cpj-tab-btn');
    const tabContents = document.querySelectorAll('.cpj-tab-content-box');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-tab');
            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            this.classList.add('active');
            const target = document.getElementById(targetId);
            if (target) target.classList.add('active');
        });
    });
});
</script>
@endsection
