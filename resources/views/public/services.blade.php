@extends('layouts.public')
@section('title', 'Como Funciona a Cotech Contabilidade | Serviços e Soluções')
@section('description', 'Conheça como funciona a contabilidade inteligente da Cotech: abertura de empresa, processos digitais, notas fiscais, assessoria dedicada e atendimento especializado.')

@section('content')
<!-- 01. HERO SECTION -->
<section class="srv-hero">
    <div class="srv-hero-glow glow-1" aria-hidden="true"></div>
    <div class="srv-hero-glow glow-2" aria-hidden="true"></div>
    <div class="container srv-hero-grid">
        <div class="srv-hero-copy" data-reveal>
            <span class="srv-badge"><i class="live-dot"></i> COTECH / COMO FUNCIONA</span>
            <h1>Como funciona a<br><span class="ink-blue">Cotech Contabilidade?</span></h1>
            <p class="srv-hero-lead">Unimos inteligência contábil, processos digitais ágeis e assessoria próxima para descomplicar sua rotina fiscal, proteger sua empresa e dar clareza a cada decisão de crescimento.</p>
            <div class="srv-hero-actions">
                <a class="button blue-button" href="/orcamento">Converse sobre planos <span>↗</span></a>
                <a class="button srv-button-ghost" href="/orcamento">Fale com um especialista <span>↗</span></a>
            </div>
            <div class="srv-hero-trust">
                <span>✓ Atendimento 100% humanizado</span>
                <span>✓ Contadores certificados pelo CRC</span>
                <span>✓ Plataforma digital 24h</span>
            </div>
        </div>
        <div class="srv-hero-visual" data-reveal>
            <div class="srv-visual-frame">
                <img src="/images/specialist-consultant.jpg" alt="Consultora sênior da Cotech em atendimento" width="560" height="420" loading="eager">
                <div class="srv-glass-card card-top">
                    <span class="srv-glass-icon">🛡️</span>
                    <div>
                        <strong>100% Regularizada</strong>
                        <small>Conformidade fiscal contínua</small>
                    </div>
                </div>
                <div class="srv-glass-card card-bottom">
                    <span class="srv-glass-icon">📈</span>
                    <div>
                        <strong>Tecnologia + Proximidade</strong>
                        <small>Gestão inteligente do seu negócio</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HERO HIGHLIGHT CARDS -->
    <div class="container srv-highlight-cards" data-reveal>
        <div class="srv-highlight-card">
            <div class="srv-highlight-icon">📝</div>
            <div>
                <h3>CNPJ Rápido & Abertura Sem Sair de Casa</h3>
                <p>Cuidamos de todo o processo de abertura ou regularização do seu CNPJ com rapidez e suporte completo.</p>
            </div>
        </div>
        <div class="srv-highlight-card">
            <div class="srv-highlight-icon">⚖️</div>
            <div>
                <h3>Otimização Tributária Estratégica</h3>
                <p>Estudamos o enquadramento ideal para que você pague apenas os impostos necessários dentro da lei.</p>
            </div>
        </div>
        <div class="srv-highlight-card">
            <div class="srv-highlight-icon">⚡</div>
            <div>
                <h3>Atendimento Rápido e Consultivo</h3>
                <p>Tire dúvidas e receba orientação contábil via WhatsApp, telefone, e-mail ou videoconferência.</p>
            </div>
        </div>
    </div>
</section>

<!-- 02. HOW WE SUPPORT / COMO APOIAMOS VOCÊ -->
<section class="section srv-support-section" id="como-apoiamos">
    <div class="container">
        <div class="section-head" data-reveal>
            <div>
                <span class="eyebrow">DO PRIMEIRO PASSO AO CRESCIMENTO</span>
                <h2>Cuidamos de tudo para você<br><span class="ink-blue">focar no seu negócio.</span></h2>
            </div>
            <p class="section-aside">Seja abrindo sua empresa, crescendo além do MEI ou mudando de contador, oferecemos suporte completo e sem fricção.</p>
        </div>

        <div class="srv-tabs-wrapper" data-reveal>
            <div class="srv-category-tabs" role="tablist" aria-label="Categorias de suporte">
                <button class="srv-tab-btn active" role="tab" id="tab-abrir" aria-selected="true" aria-controls="panel-abrir" data-srv-tab="0">
                    <span class="tab-num">01</span>
                    <span class="tab-label">Abrir Empresa Grátis</span>
                </button>
                <button class="srv-tab-btn" role="tab" id="tab-mei" aria-selected="false" aria-controls="panel-mei" data-srv-tab="1">
                    <span class="tab-num">02</span>
                    <span class="tab-label">Deixar de ser MEI</span>
                </button>
                <button class="srv-tab-btn" role="tab" id="tab-mudar" aria-selected="false" aria-controls="panel-mudar" data-srv-tab="2">
                    <span class="tab-num">03</span>
                    <span class="tab-label">Mudar de Contador</span>
                </button>
            </div>

            <div class="srv-tab-panels">
                <!-- PANEL 1: ABRIR EMPRESA -->
                <div class="srv-tab-panel active" id="panel-abrir" role="tabpanel" aria-labelledby="tab-abrir">
                    <div class="srv-steps-grid">
                        <div class="srv-step-box">
                            <span class="srv-step-number">01</span>
                            <h4>Orientamos você em todas as escolhas</h4>
                            <p>Analisamos as características do seu negócio e orientamos na escolha do melhor CNAE, tipo societário, regime de tributação e emissão do certificado digital.</p>
                        </div>
                        <div class="srv-step-box">
                            <span class="srv-step-number">02</span>
                            <h4>Realizamos todo o processo de abertura</h4>
                            <p>Elaboramos o contrato social, protocolamos toda a documentação perante a Junta Comercial, Receita Federal e Prefeitura, mantendo você informado a cada etapa.</p>
                        </div>
                        <div class="srv-step-box">
                            <span class="srv-step-number">03</span>
                            <h4>Cuidamos da sua contabilidade mês a mês</h4>
                            <p>Com o CNPJ ativo, cuidamos do cálculo de impostos, guias fiscais, relatórios contábeis e folha de pagamento, com acesso total na nossa plataforma online.</p>
                        </div>
                    </div>
                    <div class="srv-panel-action">
                        <a class="button blue-button" href="/orcamento">Abra sua empresa com a Cotech <span>↗</span></a>
                        <a class="text-link" href="/orcamento">Converse sobre planos <span>↗</span></a>
                    </div>
                </div>

                <!-- PANEL 2: DEIXAR DE SER MEI -->
                <div class="srv-tab-panel" id="panel-mei" role="tabpanel" aria-labelledby="tab-mei" hidden>
                    <div class="srv-steps-grid">
                        <div class="srv-step-box">
                            <span class="srv-step-number">01</span>
                            <h4>Apoiamos você na tomada de decisão</h4>
                            <p>Nossa equipe de especialistas avalia o perfil do seu MEI, faturamento acumulado e motivos para a transição, garantindo segurança na mudança para Microempresa (ME).</p>
                        </div>
                        <div class="srv-step-box">
                            <span class="srv-step-number">02</span>
                            <h4>Realizamos o processo de transformação</h4>
                            <p>Verificamos pendências fiscais, efetuamos a alteração contratual nos órgãos competentes e desenquadramos sua empresa com total conformidade cadastral.</p>
                        </div>
                        <div class="srv-step-box">
                            <span class="srv-step-number">03</span>
                            <h4>Estruturação contábil para o seu novo porte</h4>
                            <p>Integramos sua nova empresa à nossa plataforma, habilitando emissão ampliada de notas fiscais, pró-labore dos sócios e planejamento para expansão sustentável.</p>
                        </div>
                    </div>
                    <div class="srv-panel-action">
                        <a class="button blue-button" href="/orcamento">Transforme seu MEI em ME <span>↗</span></a>
                        <a class="text-link" href="/orcamento">Converse sobre planos <span>↗</span></a>
                    </div>
                </div>

                <!-- PANEL 3: MUDAR DE CONTADOR -->
                <div class="srv-tab-panel" id="panel-mudar" role="tabpanel" aria-labelledby="tab-mudar" hidden>
                    <div class="srv-steps-grid">
                        <div class="srv-step-box">
                            <span class="srv-step-number">01</span>
                            <h4>Diagnóstico inicial da sua empresa</h4>
                            <p>Realizamos uma análise detalhada das informações contábeis e fiscais para garantir que todas as obrigações estejam em dia antes de iniciar a transição.</p>
                        </div>
                        <div class="srv-step-box">
                            <span class="srv-step-number">02</span>
                            <h4>Cuidamos da transição sem dor de cabeça</h4>
                            <p>Nossa equipe entra em contato com o seu antigo contador para solicitar os arquivos e documentações legais. Você não precisa se preocupar com atritos operacionais.</p>
                        </div>
                        <div class="srv-step-box">
                            <span class="srv-step-number">03</span>
                            <h4>Nova experiência contábil, próxima e ágil</h4>
                            <p>Cadastramos sua empresa em nossa plataforma digital e alinhamos um canal direto de atendimento com contadores que realmente respondem rápido.</p>
                        </div>
                    </div>
                    <div class="srv-panel-action">
                        <a class="button blue-button" href="/orcamento">Troque para a Cotech <span>↗</span></a>
                        <a class="text-link" href="/orcamento">Converse sobre planos <span>↗</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 03. OUR SOLUTIONS / SIMPLIFICAMOS O DIA A DIA -->
<section class="section srv-solutions-section">
    <div class="container">
        <div class="section-head" data-reveal>
            <div>
                <span class="eyebrow">ECOSSISTEMA COMPLETO</span>
                <h2>Simplificamos o dia a dia<br><span class="ink-blue">dos nossos clientes.</span></h2>
            </div>
            <p class="section-aside">Oferecemos diversas soluções especializadas aliadas à gestão contábil estratégica da sua empresa.</p>
        </div>

        <div class="srv-solutions-grid">
            <!-- 1 -->
            <div class="srv-sol-card" data-reveal>
                <div class="srv-sol-icon">🏢</div>
                <h3>Abertura e regularização de empresas</h3>
                <p>Abertura ágil de empresas, regularização cadastral, emissão de alvarás e alterações contratuais sem burocracia.</p>
                <a class="text-link" href="/servicos/abertura-e-regularizacao-de-empresas">Saiba mais ↗</a>
            </div>

            <!-- 2 -->
            <div class="srv-sol-card" data-reveal>
                <div class="srv-sol-icon">📄</div>
                <h3>Abertura de CNPJ</h3>
                <p>Abra seu CNPJ com rapidez, suporte contábil completo e escolha do enquadramento tributário mais econômico.</p>
                <a class="text-link" href="/servicos/abertura-de-cnpj">Saiba mais ↗</a>
            </div>

            <!-- 3 -->
            <div class="srv-sol-card" data-reveal>
                <div class="srv-sol-icon">💰</div>
                <h3>Consultoria tributária e financeira</h3>
                <p>Planejamento tributário estratégico, redução legal de impostos, fluxo de caixa e gestão financeira para o seu crescimento.</p>
                <a class="text-link" href="/servicos/consultoria-tributaria-e-financeira">Saiba mais ↗</a>
            </div>

            <!-- 4 -->
            <div class="srv-sol-card" data-reveal>
                <div class="srv-sol-icon">👥</div>
                <h3>Departamento pessoal / RH</h3>
                <p>Gestão completa de folha de pagamento, admissões, rescisões, eSocial e cumprimento rigoroso das rotinas trabalhistas.</p>
                <a class="text-link" href="/servicos/departamento-pessoal-rh">Saiba mais ↗</a>
            </div>

            <!-- 5 -->
            <div class="srv-sol-card" data-reveal>
                <div class="srv-sol-icon">👤</div>
                <h3>Serviços para pessoa física</h3>
                <p>Declaração de Imposto de Renda (IRPF), regularização de CPF, apuração de ganho de capital e assessoria para autônomos.</p>
                <a class="text-link" href="/servicos/servicos-para-pessoa-fisica">Saiba mais ↗</a>
            </div>

            <!-- 6 -->
            <div class="srv-sol-card" data-reveal>
                <div class="srv-sol-icon">🧾</div>
                <h3>Serviços para MEIA</h3>
                <p>Abertura, regularização do DASN-SIMEI, parcelamento de débitos, desenquadramento para ME e assessoria para microempreendedores.</p>
                <a class="text-link" href="/servicos/servicos-para-mei">Saiba mais ↗</a>
            </div>
        </div>
    </div>
</section>

<!-- 05. FAQS SECTION -->
<section class="section srv-faq-section" id="faq">
    <div class="container srv-faq-grid">
        <div class="srv-faq-aside" data-reveal>
            <span class="eyebrow">DÚVIDAS FREQUENTES</span>
            <h2>Boas perguntas.<br><span class="ink-blue">Respostas claras.</span></h2>
            <p class="muted">Tire suas principais dúvidas sobre custos, processos e rotinas contábeis com a Cotech.</p>
            <div class="srv-faq-contact-card">
                <strong>Ainda tem dúvidas?</strong>
                <p>Nossa equipe está pronta para conversar agora mesmo.</p>
                <a class="button blue-button" href="/orcamento">Fale com a Cotech <span>↗</span></a>
            </div>
        </div>

        <div class="srv-faq-accordion" data-reveal>
            <details name="cotech-faq" open>
                <summary>
                    <span class="faq-num">01</span>
                    <span class="faq-quest">Quanto em média custa um contador para a minha empresa?</span>
                    <span class="faq-toggle" aria-hidden="true">+</span>
                </summary>
                <div class="faq-body">
                    <p>O valor depende do regime tributário, faturamento, atividade e número de funcionários. Fale com nossos especialistas para receber uma proposta adequada à sua empresa.</p>
                </div>
            </details>

            <details name="cotech-faq">
                <summary>
                    <span class="faq-num">02</span>
                    <span class="faq-quest">Preciso de contador para abrir ou manter minha empresa?</span>
                    <span class="faq-toggle" aria-hidden="true">+</span>
                </summary>
                <div class="faq-body">
                    <p>Sim. Pela legislação brasileira, toda empresa que não seja MEI é obrigada por lei a manter a escrituração contábil assinada por um profissional registrado no Conselho Regional de Contabilidade (CRC). O contador é quem cuida da conformidade perante a Receita Federal, Estado e Prefeitura.</p>
                </div>
            </details>

            <details name="cotech-faq">
                <summary>
                    <span class="faq-num">03</span>
                    <span class="faq-quest">O que está incluso na mensalidade da Cotech?</span>
                    <span class="faq-toggle" aria-hidden="true">+</span>
                </summary>
                <div class="faq-body">
                    <p>Todas as atividades contábeis, tributárias e de folha de pagamento exigidas pelos órgãos públicos estão inclusas: cálculo e emissão de guias de impostos (DAS/DARF/GPS), relatórios fiscais oficiais (DRE, Balanço, Balancete), envio de declarações obrigatórias anuais, além de suporte nos nossos canais e acesso ilimitado à plataforma digital.</p>
                </div>
            </details>

            <details name="cotech-faq">
                <summary>
                    <span class="faq-num">04</span>
                    <span class="faq-quest">A Cotech tem contadores de verdade registrados no CRC?</span>
                    <span class="faq-toggle" aria-hidden="true">+</span>
                </summary>
                <div class="faq-body">
                    <p>Sim! Nossa equipe é formada por contadores certificados e auditados com registro ativo no Conselho Regional de Contabilidade (CRC). Unimos a conveniência de ferramentas digitais modernas à responsabilidade técnica de especialistas humanos que assinam e garantem a regularidade da sua empresa.</p>
                </div>
            </details>

            <details name="cotech-faq">
                <summary>
                    <span class="faq-num">05</span>
                    <span class="faq-quest">Preciso sair de casa para abrir minha empresa com a Cotech?</span>
                    <span class="faq-toggle" aria-hidden="true">+</span>
                </summary>
                <div class="faq-body">
                    <p>Não. Todo o processo de abertura é realizado de maneira 100% digital. Cuidamos do contrato social, registro na Junta Comercial, Receita Federal e liberação do alvará municipal sem que você precise enfrentar filas em órgãos públicos.</p>
                </div>
            </details>
        </div>
    </div>
</section>

<!-- JAVASCRIPT FOR SERVICES TABS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Support Tabs Switcher
    const tabButtons = document.querySelectorAll('.srv-tab-btn');
    const tabPanels = document.querySelectorAll('.srv-tab-panel');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabIndex = this.getAttribute('data-srv-tab');
            tabButtons.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            tabPanels.forEach(p => {
                p.classList.remove('active');
                p.hidden = true;
            });

            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');
            if (tabPanels[tabIndex]) {
                tabPanels[tabIndex].classList.add('active');
                tabPanels[tabIndex].hidden = false;
            }
        });
    });

    // 2. Pricing Toggle (Serviços vs Comércio)
});
</script>
@endsection
