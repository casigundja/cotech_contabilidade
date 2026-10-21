@extends('layouts.public')
@section('title', 'Calculadora de Custo para Abrir CNPJ 2026: Simule Taxas e Economia | Cotech')
@section('description', 'Simule grátis as taxas da Junta Comercial, alvará, certificado digital e veja quanto custa abrir seu CNPJ em 2026. Abra sua empresa com honorários grátis na Cotech.')

@section('content')
<!-- BREADCRUMB -->
<div class="calc-breadcrumb-bar">
    <div class="container">
        <nav aria-label="Navegação estrutural">
            <a href="/">Início</a>
            <span class="sep">/</span>
            <a href="/calculadoras">Calculadoras</a>
            <span class="sep">/</span>
            <span class="current">Calculadora de Custo para Abrir CNPJ</span>
        </nav>
    </div>
</div>

<!-- 01. HERO DA PÁGINA -->
<div class="calc-page-hero">
    <div class="container" data-reveal>
        <span class="eyebrow">SIMULADOR EXCLUSIVO COTECH</span>
        <h1>Calculadora de Custo para Abrir CNPJ<br><span class="ink-blue">simule taxas e veja como abrir com honorários grátis</span></h1>
        <p class="muted">A calculadora de custo para abrir empresa é uma ferramenta gratuita que detalha as taxas estaduais, municipais, certificado digital e honorários contábeis para tirar o seu CNPJ em 2026. Descubra quanto você investirá e quanto economiza abrindo com a Cotech.</p>
    </div>
</div>

<!-- 02. SECTION CALCULADORA INTERATIVA -->
<section class="section calc-main-section">
    <div class="container">
        <div class="calc-card-grid">
            <!-- FORMULÁRIO DE ENTRADA -->
            <div class="calc-inputs-card" data-reveal>
                <div class="calc-card-header">
                    <span class="calc-step-tag">PASSO 1 DE 2</span>
                    <h3>Simule o custo do seu CNPJ</h3>
                    <p class="calc-subtitle">Preencha as informações do seu negócio para estimar as taxas oficiais do seu Estado:</p>
                </div>

                <div class="calc-form-group">
                    <label for="cnpj-uf">1. Em qual Estado a empresa será registrada? *</label>
                    <select id="cnpj-uf" class="calc-input">
                        <option value="SP" selected>São Paulo (SP) — JUCESP</option>
                        <option value="RJ">Rio de Janeiro (RJ) — JUCERJA</option>
                        <option value="MG">Minas Gerais (MG) — JUCEMG</option>
                        <option value="PR">Paraná (PR) — JUCEPAR</option>
                        <option value="RS">Rio Grande do Sul (RS) — JUCISRS</option>
                        <option value="SC">Santa Catarina (SC) — JUCESC</option>
                        <option value="BA">Bahia (BA) — JUCEB</option>
                        <option value="PE">Pernambuco (PE) — JUCEPE</option>
                        <option value="CE">Ceará (CE) — JUCEC</option>
                        <option value="DF">Distrito Federal (DF) — JUCIS-DF</option>
                        <option value="GO">Goiás (GO) — JUCEG</option>
                        <option value="OUTRO">Outros Estados do Brasil</option>
                    </select>
                    <small class="calc-field-help">A taxa da Junta Comercial varia de acordo com cada unidade da federação.</small>
                </div>

                <div class="calc-form-group">
                    <label for="cnpj-tipo">2. Qual o Tipo Societário da Empresa? *</label>
                    <select id="cnpj-tipo" class="calc-input">
                        <option value="SLU" selected>Sociedade Limitada Unipessoal (SLU — 1 sócio, patrimônio protegido)</option>
                        <option value="LTDA">Sociedade Limitada (LTDA — 2 ou mais sócios com proteção patrimonial)</option>
                        <option value="EI">Empresário Individual (EI — sem separação de bens pessoais)</option>
                    </select>
                </div>

                <div class="calc-form-group">
                    <label for="cnpj-atividade">3. Qual será a Atividade Principal? *</label>
                    <select id="cnpj-atividade" class="calc-input">
                        <option value="servico" selected>Prestação de Serviços / TI / Software / Consultoria</option>
                        <option value="saude">Saúde / Médicos / Psicologia / Odontologia</option>
                        <option value="engenharia">Engenharia / Arquitetura / Projetos Técnicos</option>
                        <option value="comercio">Comércio Varejista / E-commerce</option>
                    </select>
                </div>

                <div class="calc-form-group">
                    <label for="cnpj-faturamento">4. Faturamento Mensal Estimado (R$)</label>
                    <input type="number" id="cnpj-faturamento" class="calc-input" value="15000" min="2000" step="1000">
                    <small class="calc-field-help">Ajuda a definir o enquadramento fiscal ideal (Simples Nacional vs Lucro Presumido).</small>
                </div>

                <div class="calc-form-group">
                    <label class="calc-checkbox-label">
                        <input type="checkbox" id="cnpj-tem-certificado" checked>
                        <span>Incluir Certificado Digital e-CNPJ A1 (Obrigatório para emissão de notas fiscais)</span>
                    </label>
                </div>

                <button type="button" class="button blue-button full-width" id="btn-calc-cnpj">Calcular Custos Agora ↗</button>

                <small class="calc-tip" style="margin-top: 14px; text-align: center;">
                    ⚖️ Ao utilizar esta ferramenta, você declara estar ciente de que os valores apresentados são estimativas baseadas nas tabelas públicas das Juntas Comerciais e prefeituras em 2026.
                </small>
            </div>

            <!-- RESULTADOS INTERATIVOS -->
            <div class="calc-results-card" data-reveal>
                <span class="calc-badge-green">ESTIMATIVA TRANSPARENTE</span>

                <div class="calc-result-header">
                    <small>Honorários Cotech para abertura do CNPJ:</small>
                    <div class="calc-big-value text-green">R$ 0,00 <span class="tag-free">100% GRÁTIS</span></div>
                    <p class="calc-note">Não cobramos nada para registrar sua empresa ao contratar nosso plano de contabilidade.</p>
                </div>

                <div class="calc-breakdown-list">
                    <div class="breakdown-item">
                        <span>Taxa Junta Comercial estadual:</span>
                        <strong id="res-cnpj-junta">R$ 202,00</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Taxa Municipal (Alvará / Licenças):</span>
                        <strong id="res-cnpj-alvara">R$ 0,00 (Isento p/ serviços)</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Certificado Digital e-CNPJ A1:</span>
                        <strong id="res-cnpj-cert">R$ 179,00</strong>
                    </div>
                    <div class="breakdown-item highlight-total">
                        <span>Custo Total Estimado de Taxas Oficiais:</span>
                        <strong class="text-blue" id="res-cnpj-total">R$ 381,00</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Honorários em Contabilidade Tradicional:</span>
                        <strong class="text-strike" id="res-cnpj-tradicional">R$ 1.500,00</strong>
                    </div>
                    <div class="breakdown-item highlight-saving">
                        <span>Sua Economia abrindo com a Cotech:</span>
                        <strong class="text-green" id="res-cnpj-economia">R$ 1.500,00</strong>
                    </div>
                </div>

                <div class="calc-winner-banner">
                    <span class="winner-icon">🎯</span>
                    <div>
                        <strong>Processo 100% Digital e Descomplicado:</strong>
                        <p>Você envia os documentos pelo celular ou computador e nosso time cuida de toda a Junta Comercial, Receita e Prefeitura.</p>
                    </div>
                </div>

                <div class="calc-cta-box">
                    <a class="button blue-button full-width" id="cnpj-cta-link" href="/orcamento?servico=abrir-cnpj">Quero Abrir Meu CNPJ Grátis ↗</a>
                    <span class="calc-security-note">🔒 Sem letras miúdas • Atendimento humanizado por contadores CRC</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 03. SEÇÃO COMO CALCULAR O CUSTO PARA TIRAR CNPJ -->
<section class="section calc-info-section">
    <div class="container" data-reveal>
        <div class="calc-section-head">
            <span class="eyebrow">DETALHAMENTO FINANCEIRO</span>
            <h2>Como calcular o custo para tirar CNPJ</h2>
            <p>Para calcular o custo total de abertura de um CNPJ é necessário somar as taxas governamentais obrigatórias com os custos de estruturação e honorários profissionais. Entenda cada um dos valores:</p>
        </div>

        <div class="calc-info-grid">
            <div class="calc-info-card">
                <div class="calc-info-icon">🏛️</div>
                <h3>Taxa da Junta Comercial (DREI)</h3>
                <p>Taxa cobrada pelo governo estadual para protocolar e deferir o Contrato Social ou Ato Constitutivo da empresa. O valor é fixado por cada estado (por exemplo, a JUCESP em SP cobra por volta de R$ 202, enquanto a JUCERJA no RJ cobra aproximadamente R$ 454 para sociedades limitadas).</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🏢</div>
                <h3>Inscrição Municipal e Alvará</h3>
                <p>Cobrado pela prefeitura do município onde a empresa terá sede. Em cidades como São Paulo e diversas capitais, atividades de prestação de serviços intelectuais (TI, consultoria, marketing) que não geram fluxo de público são isentas ou dispensadas de alvará presencial e taxa de funcionamento (TFE).</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🔐</div>
                <h3>Certificado Digital e-CNPJ A1</h3>
                <p>A identidade eletrônica da sua pessoa jurídica. É indispensável para emitir notas fiscais eletrônicas (NF-e/NFS-e), acessar o e-CAC da Receita Federal e assinar procurações. A Cotech possui convênios especiais para você emitir seu e-CNPJ por videoconferência com desconto.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🤝</div>
                <h3>Honorários do Contador (Grátis na Cotech!)</h3>
                <p>Enquanto escritórios de contabilidade convencionais chegam a cobrar de R$ 1.000 a R$ 2.000 apenas para redigir o contrato e protocolar o processo, <strong>na Cotech você não paga nada de honorários de abertura</strong> caso seja cliente dos nossos planos de contabilidade mensal.</p>
            </div>
        </div>
    </div>
</section>

<!-- 04. SEÇÃO PRINCIPAIS TIPOS SOCIETÁRIOS (SLU, LTDA, EI, MEI) -->
<section class="section calc-table-section">
    <div class="container" data-reveal>
        <div class="calc-section-head">
            <span class="eyebrow">GUIA SOCIETÁRIO ESTRATÉGICO</span>
            <h2>Principais tipos de empresa: SLU, LTDA, EI e MEI</h2>
            <p>A escolha da natureza jurídica define como os bens pessoais dos sócios são protegidos, as exigências de capital social e os custos de registro na Junta Comercial:</p>
        </div>

        <div class="table-wrap">
            <table class="calc-comparison-table">
                <thead>
                    <tr>
                        <th>Característica</th>
                        <th>MEI (Microempreendedor)</th>
                        <th>SLU (Limitada Unipessoal)</th>
                        <th>LTDA (Com Sócios)</th>
                        <th>EI (Empresário Individual)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Quantidade de Sócios</strong></td>
                        <td>Apenas 1 titular</td>
                        <td>Apenas 1 titular (100% do capital)</td>
                        <td>2 ou mais sócios</td>
                        <td>Apenas 1 titular</td>
                    </tr>
                    <tr>
                        <td><strong>Proteção Patrimonial</strong></td>
                        <td>❌ Não separa bens pessoais</td>
                        <td>✅ Sim, bens do sócio protegidos</td>
                        <td>✅ Sim, bens dos sócios protegidos</td>
                        <td>❌ Não separa bens pessoais</td>
                    </tr>
                    <tr>
                        <td><strong>Capital Social Mínimo</strong></td>
                        <td>Não exige valor mínimo</td>
                        <td>Não exige valor mínimo (qualquer valor)</td>
                        <td>Não exige valor mínimo</td>
                        <td>Não exige valor mínimo</td>
                    </tr>
                    <tr>
                        <td><strong>Limite de Faturamento</strong></td>
                        <td>Até R$ 81.000/ano (R$ 6.750/mês)</td>
                        <td>Até R$ 4,8 milhões/ano (Simples)</td>
                        <td>Até R$ 4,8 milhões/ano (Simples)</td>
                        <td>Até R$ 4,8 milhões/ano (Simples)</td>
                    </tr>
                    <tr>
                        <td><strong>Atividades Permitidas</strong></td>
                        <td>Apenas atividades operacionais básicas</td>
                        <td>Qualquer atividade (TI, Consultoria, etc.)</td>
                        <td>Qualquer atividade permitida por lei</td>
                        <td>Diversas atividades permitidas</td>
                    </tr>
                    <tr>
                        <td><strong>Honorários Cotech para Abrir</strong></td>
                        <td>Gratuito pelo Portal gov.br</td>
                        <td><strong class="text-green">R$ 0,00 nos nossos planos</strong></td>
                        <td><strong class="text-green">R$ 0,00 nos nossos planos</strong></td>
                        <td><strong class="text-green">R$ 0,00 nos nossos planos</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- 05. BANNER ASSESSORIA CONTÁBIL SEM CUSTO COM CONTADORES COTECH -->
<section class="calc-expert-banner-section">
    <div class="container" data-reveal>
        <div class="calc-expert-banner-card">
            <div class="calc-expert-content">
                <span class="calc-expert-badge">ATENDIMENTO CONSULTIVO COTECH</span>
                <h2>Tenha uma assessoria contábil sem custo com os nossos contadores</h2>
                <p>Nossos contadores seniores com registro no CRC analisam seu perfil profissional para definir a atividade econômica (CNAE) ideal, enquadrar seu CNPJ no Simples Nacional e aplicar o benefício do Fator R para você pagar apenas 6% de impostos.</p>

                <ul class="calc-expert-checklist">
                    <li><span class="check-icon">✓</span> Contadores certificados com registro ativo no Conselho Regional de Contabilidade (CRC)</li>
                    <li><span class="check-icon">✓</span> Processo de abertura de empresa sem taxa de honorários profissionais</li>
                    <li><span class="check-icon">✓</span> Atendimento próximo e humanizado via WhatsApp, telefone e videoconferência</li>
                    <li><span class="check-icon">✓</span> Planejamento tributário prévio antes de enviar qualquer documento aos órgãos públicos</li>
                </ul>

                <div class="calc-expert-actions">
                    <a class="button blue-button" href="/orcamento?servico=abrir-cnpj">Falar com um Consultor Contábil <span>↗</span></a>
                    @if($wa = \App\Support\Company::whatsapp())
                    <a class="button srv-button-ghost" href="{{ $wa }}" target="_blank" rel="noopener">Conversar pelo WhatsApp <span>↗</span></a>
                    @endif
                </div>
            </div>
            <div class="calc-expert-image">
                <img src="/images/specialist-consultant.jpg" alt="Consultores especialistas Cotech prontos para abrir sua empresa" width="460" height="420" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- 06. SEÇÃO DE ABAS / ACCORDION: OUTRAS INFORMAÇÕES IMPORTANTES -->
<section class="section calc-tabs-section">
    <div class="container" data-reveal>
        <div class="calc-section-head">
            <span class="eyebrow">GUIA DEFINITIVO</span>
            <h2>Outras informações importantes sobre abertura de CNPJ</h2>
            <p>Conheça cada detalhe sobre prazos, documentação, obrigações mensais e a economia real ao formalizar sua empresa:</p>
        </div>

        <!-- ABAS DE NAVEGAÇÃO -->
        <div class="calc-info-tabs-nav">
            <button type="button" class="calc-info-tab-btn active" data-tab="tab-processo">Como é feita a abertura?</button>
            <button type="button" class="calc-info-tab-btn" data-tab="tab-obrigacoes">Quais são as obrigações?</button>
            <button type="button" class="calc-info-tab-btn" data-tab="tab-direitos">Quais são os direitos e vantagens?</button>
            <button type="button" class="calc-info-tab-btn" data-tab="tab-custos-mensais">Quais os custos mensais?</button>
        </div>

        <!-- CONTEÚDO DAS ABAS -->
        <!-- ABA 1: PROCESSO DE ABERTURA -->
        <div class="calc-info-tab-content active" id="tab-processo">
            <div class="calc-tab-grid">
                <div class="calc-tab-card">
                    <h3>🏛️ Passo a Passo da Abertura de Empresa</h3>
                    <p>Abrir uma empresa hoje no Brasil é um processo 100% eletrônico. A Cotech cuida de todas as etapas burocráticas:</p>
                    <ul>
                        <li><strong>1. Consulta Prévia de Viabilidade:</strong> Verificação da viabilidade do nome empresarial e do endereço sede junto à Prefeitura e Junta Comercial.</li>
                        <li><strong>2. Elaboração do Contrato Social:</strong> Nossos advogados e contadores redigem o contrato personalizado com as cláusulas societárias de proteção patrimonial.</li>
                        <li><strong>3. DBE na Receita Federal:</strong> Protocolo do Documento Básico de Entrada via Redesim para registro do CNPJ.</li>
                        <li><strong>4. Registro na Junta Comercial:</strong> Assinatura digital com seu certificado e homologação do ato constitutivo estadual.</li>
                        <li><strong>5. Inscrição Municipal e Alvará:</strong> Liberação do cadastro municipal de prestadores de serviço e emissão de NFS-e.</li>
                    </ul>
                </div>
                <div class="calc-tab-card">
                    <h3>⏱️ Prazos e Documentos Necessários</h3>
                    <p>Para iniciar o seu processo, você precisa apenas ter em mãos documentos simples em formato digital:</p>
                    <ul>
                        <li><strong>RG ou CNH:</strong> Cópia digitalizada do documento de identificação com foto dos sócios.</li>
                        <li><strong>Comprovante de Residência:</strong> Conta recente de consumo (luz, água ou telefone) dos sócios.</li>
                        <li><strong>Carnê do IPTU:</strong> Número do IPTU do imóvel onde a empresa será sediada (pode ser seu endereço residencial em muitas atividades).</li>
                        <li><strong>Tempo Médio de Abertura:</strong> De <strong>3 a 10 dias úteis</strong> em São Paulo, Minas Gerais, Rio de Janeiro e principais capitais do país.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ABA 2: OBRIGAÇÕES -->
        <div class="calc-info-tab-content" id="tab-obrigacoes">
            <div class="calc-tab-grid">
                <div class="calc-tab-card">
                    <h3>📋 Obrigações Fiscais e Contábeis Mensais</h3>
                    <p>Ao ter um CNPJ ativo, sua empresa precisa cumprir certas rotinas para se manter em total conformidade com a Receita Federal:</p>
                    <ul>
                        <li><strong>Emissão de Notas Fiscais:</strong> Emitir nota fiscal eletrônica para cada serviço prestado ou venda realizada.</li>
                        <li><strong>Guia Única de Impostos (DAS):</strong> Pagar mensalmente a guia do Simples Nacional que unifica IRPJ, CSLL, PIS, COFINS e ISS.</li>
                        <li><strong>Recolhimento Previdenciário (INSS):</strong> Recolhimento do INSS sobre o valor de pró-labore declarado pelo sócio (11%).</li>
                        <li><strong>Escrituração Fiscal e Contábil:</strong> Registro de receitas, extratos bancários, despesas e livros fiscais assinados por contador registrado no CRC.</li>
                    </ul>
                </div>
                <div class="calc-tab-card">
                    <h3>🛡️ O que a Cotech faz por você</h3>
                    <p>Você foca no seu trabalho e nós cuidamos de 100% da rotina tributária e fiscal da sua empresa:</p>
                    <ul>
                        <li><strong>Cálculo Automático de Impostos:</strong> Emitimos todas as guias de arrecadação antes do vencimento com alertas por e-mail e WhatsApp.</li>
                        <li><strong>Declarações Obrigatórias Anuais:</strong> Envio da DEFIS, DIRF, DCTFWeb, e-Social e relatórios oficiais exigidos pelos órgãos públicos.</li>
                        <li><strong>Relatórios Contábeis:</strong> Balanço Patrimonial, DRE oficial e relatórios de faturamento assinados para bancos e financiamentos.</li>
                        <li><strong>Certidões Negativas (CND):</strong> Monitoramento constante da regularidade fiscal da sua empresa perante a Receita e Município.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ABA 3: DIREITOS E VANTAGENS -->
        <div class="calc-info-tab-content" id="tab-direitos">
            <div class="calc-tab-grid">
                <div class="calc-tab-card">
                    <h3>💎 Vantagens Tributárias e Financeiras de ter CNPJ</h3>
                    <p>Trabalhar com CNPJ garante economias tributárias substanciais em comparação com a Pessoa Física:</p>
                    <ul>
                        <li><strong>Alíquota a partir de 6%:</strong> No Simples Nacional com Fator R, você paga a partir de 6% sobre seu faturamento, enquanto na PF o Imposto de Renda chega a 27,5%.</li>
                        <li><strong>Sem Retenção de INSS Abusivo:</strong> Na PF você pagaria 20% de INSS até o teto. Como PJ, o INSS incide apenas sobre seu pró-labore básico.</li>
                        <li><strong>Distribuição de Lucros Isenta:</strong> Todo o lucro líquido apurado pela contabilidade é transferido para a sua conta pessoal <strong>100% isento de IRPF</strong>.</li>
                        <li><strong>Acesso a Grandes Clientes:</strong> A maioria das empresas de tecnologia e corporações contratam exclusivamente prestadores de serviço PJ formalizados.</li>
                    </ul>
                </div>
                <div class="calc-tab-card">
                    <h3>🚗 Benefícios Corporativos e Proteção</h3>
                    <p>Além da economia fiscal, ter uma pessoa jurídica abre portas para vantagens comerciais exclusivas:</p>
                    <ul>
                        <li><strong>Planos de Saúde Empresariais:</strong> Até 40% mais baratos que planos de saúde individuais ou familiares da Pessoa Física.</li>
                        <li><strong>Desconto na Compra de Veículos:</strong> Descontos de montadoras que chegam a 20% para compras faturadas no CNPJ.</li>
                        <li><strong>Crédito e Financiamento com Juros Menores:</strong> Linhas de crédito como Pronampe e capital de giro com condições diferenciadas.</li>
                        <li><strong>Proteção do Patrimônio Pessoal:</strong> Na SLU e LTDA, as dívidas da empresa não afetam seus bens pessoais (carro, casa, poupança).</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ABA 4: CUSTOS MENSAIS -->
        <div class="calc-info-tab-content" id="tab-custos-mensais">
            <div class="calc-tab-grid">
                <div class="calc-tab-card">
                    <h3>📊 Custos de Manutenção Mensal do CNPJ</h3>
                    <p>Diferente de boatos comuns, manter um CNPJ de serviços enquadrado no Simples Nacional é muito acessível e previsível:</p>
                    <ul>
                        <li><strong>Imposto do Simples Nacional (DAS):</strong> A partir de 6% sobre o faturamento emitido no mês (Anexo III com Fator R). Se não faturar nada no mês, não paga imposto.</li>
                        <li><strong>INSS sobre Pró-labore:</strong> 11% sobre 1 salário mínimo (aprox. R$ 167/mês), garantindo aposentadoria e auxílio-doença pelo INSS.</li>
                        <li><strong>Honorários Contábeis Cotech:</strong> A partir de R$ 195/mês com toda a contabilidade inclusa, emissor de notas e suporte ilimitado.</li>
                        <li><strong>Certificado Digital:</strong> Renovação anual do certificado e-CNPJ A1 (aprox. R$ 179 por ano, ou seja, menos de R$ 15/mês).</li>
                    </ul>
                </div>
                <div class="calc-tab-card">
                    <h3>💡 Exemplo Prático de Faturamento R$ 15.000/mês</h3>
                    <p>Veja a simulação real de custos de uma empresa de serviços faturando R$ 15.000 mensais com a Cotech:</p>
                    <ul>
                        <li><strong>Faturamento Bruto:</strong> R$ 15.000,00</li>
                        <li><strong>Imposto Simples Nacional (6%):</strong> R$ 900,00</li>
                        <li><strong>INSS do Pró-labore (11% s/ mín.):</strong> R$ 167,00</li>
                        <li><strong>Mensalidade Contábil Cotech:</strong> R$ 195,00</li>
                        <li><strong>Total de Despesas Mensais:</strong> R$ 1.262,00 (apenas 8,4% do faturamento!)</li>
                        <li><strong>Líquido no Bolso do Sócio:</strong> <strong class="text-green">R$ 13.738,00</strong> (Na CLT ou PF você ficaria com menos de R$ 10.500!)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 07. CONFIRA OUTRAS CALCULADORAS QUE AJUDARÃO VOCÊ -->
<section class="calc-other-tools-section">
    <div class="container" data-reveal>
        <div class="calc-section-head">
            <span class="eyebrow">FERRAMENTAS DE GESTÃO GRATUITAS</span>
            <h2>Confira outras calculadoras que ajudarão você no seu negócio</h2>
            <p>Utilize nossos simuladores interativos para planejar sua contratação, otimizar impostos e tomar decisões financeiras com segurança:</p>
        </div>

        <div class="calc-tools-grid">
            <a class="calc-tool-card" href="/calculadora-clt-pj">
                <div class="calc-tool-icon">⚖️</div>
                <h3>Calculadora Salário PJ x CLT</h3>
                <p>Compare os salários líquidos, 13º, férias, FGTS, benefícios e descubra quanto faturar como PJ para ganhar mais.</p>
                <span class="calc-tool-link-text">Simular PJ x CLT <span>↗</span></span>
            </a>

            <a class="calc-tool-card" href="/calculadora-fator-r">
                <div class="calc-tool-icon">📊</div>
                <h3>Calculadora de Fator R</h3>
                <p>Calcule a relação folha/faturamento e veja como enquadrar sua empresa no Anexo III pagando apenas 6% em vez de 15,5%.</p>
                <span class="calc-tool-link-text">Calcular Fator R <span>↗</span></span>
            </a>

            <a class="calc-tool-card" href="/calculadora-rpa-autonomo">
                <div class="calc-tool-icon">🧾</div>
                <h3>Calculadora RPA para Autônomos</h3>
                <p>Descubra os descontos pesados do Recibo de Autônomo (IRPF + INSS + ISS) e compare com a economia de abrir um CNPJ.</p>
                <span class="calc-tool-link-text">Simular RPA Online <span>↗</span></span>
            </a>

            <a class="calc-tool-card" href="/calculadora-reforma-tributaria">
                <div class="calc-tool-icon">📈</div>
                <h3>Calculadora Reforma Tributária</h3>
                <p>Simule os impactos da unificação dos impostos com o IBS e a CBS para planejar sua empresa com antecedência.</p>
                <span class="calc-tool-link-text">Simular Reforma <span>↗</span></span>
            </a>
        </div>
    </div>
</section>

<!-- 08. ABRIR EMPRESA É COM A COTECH (BRAND PROOF COM ARTE) -->
<section class="calc-brand-proof-section">
    <div class="container" data-reveal>
        <div class="calc-brand-proof-grid">
            <div class="calc-brand-proof-visual">
                <img src="/images/cotech-abrir-empresa.jpg" alt="Contador especialista Cotech cuidando da abertura da sua empresa" class="calc-brand-proof-img" width="560" height="420" loading="lazy">
            </div>

            <div class="calc-brand-proof-content">
                <span class="eyebrow">TECNOLOGIA + PROXIMIDADE</span>
                <h2>Abrir empresa é com a Cotech</h2>
                <p class="brand-lead">Somos especialistas em transformar burocracia contábil em simplicidade. Combinamos plataforma digital de ponta com o cuidado consultivo de contadores registrados que entendem a realidade do seu negócio:</p>

                <div class="calc-solutions-grid">
                    <div class="calc-sol-item">
                        <div class="calc-sol-icon">🛡️</div>
                        <div class="calc-sol-info">
                            <strong>100% Regularizada</strong>
                            <p>Sua empresa cumpre todas as obrigações pagando o mínimo de imposto legal.</p>
                        </div>
                    </div>

                    <div class="calc-sol-item">
                        <div class="calc-sol-icon">📝</div>
                        <div class="calc-sol-info">
                            <strong>Suporte Completo</strong>
                            <p>Cuidamos da viabilidade, contrato social, Junta Comercial e prefeitura.</p>
                        </div>
                    </div>

                    <div class="calc-sol-item">
                        <div class="calc-sol-icon">⚡</div>
                        <div class="calc-sol-info">
                            <strong>Agilidade Comprovada</strong>
                            <p>CNPJ emitido entre 3 a 10 dias úteis sem filas de cartório ou papelada.</p>
                        </div>
                    </div>

                    <div class="calc-sol-item">
                        <div class="calc-sol-icon">💬</div>
                        <div class="calc-sol-info">
                            <strong>Atendimento Humanizado</strong>
                            <p>Canais rápidos no WhatsApp, telefone, e-mail e videoconferência.</p>
                        </div>
                    </div>

                    <div class="calc-sol-item">
                        <div class="calc-sol-icon">🎯</div>
                        <div class="calc-sol-info">
                            <strong>Especialistas no seu Nicho</strong>
                            <p>Planejamento tributário focado em TI, consultoria, saúde e serviços.</p>
                        </div>
                    </div>

                    <div class="calc-sol-item">
                        <div class="calc-sol-icon">💰</div>
                        <div class="calc-sol-info">
                            <strong>Economia de até R$ 1.500</strong>
                            <p>Honorários de abertura 100% gratuitos ao assinar qualquer plano Cotech.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <a class="button blue-button" href="/orcamento?servico=abrir-cnpj">Quero Abrir Minha Empresa Grátis <span>↗</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 09. CONFIRA NOSSOS PLANOS -->
<section class="calc-pricing-section" id="planos">
    <div class="container" data-reveal>
        <div class="calc-section-head">
            <span class="eyebrow">VALORES TRANSPARENTES</span>
            <h2>Confira nossos planos</h2>
            <p>Planos contábeis sob medida com abertura de empresa gratuita, sem fidelidade abusiva e com suporte dedicado:</p>
        </div>

        <div class="calc-pricing-grid">
            <!-- PLANO ESSENCIAL -->
            <div class="calc-plan-card">
                <h3 class="calc-plan-name">Essencial</h3>
                <p class="calc-plan-desc">Ideal para autônomos, freelancers e prestadores de serviço com faturamento de até R$ 25 mil/mês.</p>
                <div class="calc-plan-price">
                    <small>A partir de</small>
                    <div class="calc-plan-amount">R$ 195 <span>/mês</span></div>
                </div>
                <ul class="calc-plan-features">
                    <li><span class="feat-check">✓</span> <strong>Processo de abertura 100% grátis</strong></li>
                    <li><span class="feat-check">✓</span> Contabilidade completa e fiscal mensal</li>
                    <li><span class="feat-check">✓</span> Emissor gratuito de Notas Fiscais (NFS-e)</li>
                    <li><span class="feat-check">✓</span> Cálculo e emissão de guias do Simples Nacional</li>
                    <li><span class="feat-check">✓</span> Suporte ágil via plataforma e e-mail</li>
                </ul>
                <a class="button srv-button-ghost full-width" href="/orcamento?plano=essencial">Escolher Essencial <span>↗</span></a>
            </div>

            <!-- PLANO PROFISSIONAL (DESTAQUE) -->
            <div class="calc-plan-card featured">
                <span class="calc-plan-badge">O MAIS ESCOLHIDO</span>
                <h3 class="calc-plan-name">Profissional</h3>
                <p class="calc-plan-desc">Perfeito para quem busca atendimento rápido pelo WhatsApp e planejamento tributário Fator R otimizado.</p>
                <div class="calc-plan-price">
                    <small>A partir de</small>
                    <div class="calc-plan-amount text-blue">R$ 349 <span>/mês</span></div>
                </div>
                <ul class="calc-plan-features">
                    <li><span class="feat-check">✓</span> <strong>Tudo do Plano Essencial</strong></li>
                    <li><span class="feat-check">✓</span> <strong>Atendimento prioritário via WhatsApp</strong></li>
                    <li><span class="feat-check">✓</span> Otimização ativa de Fator R (alíquota de 6%)</li>
                    <li><span class="feat-check">✓</span> Folha de pró-labore dos sócios inclusa</li>
                    <li><span class="feat-check">✓</span> Emissão assistida de notas fiscais</li>
                </ul>
                <a class="button blue-button full-width" href="/orcamento?plano=profissional">Escolher Profissional <span>↗</span></a>
            </div>

            <!-- PLANO CONSULTIVO -->
            <div class="calc-plan-card">
                <h3 class="calc-plan-name">Consultivo</h3>
                <p class="calc-plan-desc">Solução completa para empresas com equipes, múltiplos sócios ou faturamento superior a R$ 50 mil/mês.</p>
                <div class="calc-plan-price">
                    <small>Proposta sob medida</small>
                    <div class="calc-plan-amount">Consultar</div>
                </div>
                <ul class="calc-plan-features">
                    <li><span class="feat-check">✓</span> <strong>Tudo do Plano Profissional</strong></li>
                    <li><span class="feat-check">✓</span> Gestor contábil sênior dedicado</li>
                    <li><span class="feat-check">✓</span> Reuniões periódicas de planejamento estratégico</li>
                    <li><span class="feat-check">✓</span> Gestão de folha de funcionários e benefícios</li>
                    <li><span class="feat-check">✓</span> BPO financeiro e conciliação bancária sob medida</li>
                </ul>
                <a class="button srv-button-ghost full-width" href="/orcamento?plano=consultivo">Solicitar Proposta <span>↗</span></a>
            </div>
        </div>
    </div>
</section>

<!-- 10. PRECISA ABRIR SUA EMPRESA E NÃO SABE POR ONDE COMEÇAR? (COM ARTE 3D) -->
<section class="calc-start-callout-section">
    <div class="container" data-reveal>
        <div class="calc-start-callout-card">
            <div class="calc-start-content">
                <span class="eyebrow" style="margin-bottom: 8px;">MATERIAL GRATUITO</span>
                <h3>Precisa abrir sua empresa e não sabe por onde começar?</h3>
                <p class="start-lead">Receba nosso <strong>Guia Completo para Abrir CNPJ em 2026</strong> e converse com nossos consultores para tirar todas as suas dúvidas antes de protocolar:</p>

                <ul class="calc-start-checklist">
                    <li><span class="check">✓</span> Como abrir seu CNPJ de maneira 100% digital e sem burocracia</li>
                    <li><span class="check">✓</span> As vantagens fiscais e financeiras de ser Pessoa Jurídica (PJ)</li>
                    <li><span class="check">✓</span> Tabela comparativa do Simples Nacional vs Lucro Presumido</li>
                    <li><span class="check">✓</span> Passo a passo para emitir sua primeira nota fiscal eletrônica</li>
                </ul>

                <div class="calc-start-actions">
                    <a class="button blue-button" href="/orcamento?servico=abrir-cnpj">Falar com um Especialista <span>↗</span></a>
                    @if($wa = \App\Support\Company::whatsapp())
                    <a class="button srv-button-ghost" href="{{ $wa }}" target="_blank" rel="noopener">WhatsApp Direto <span>↗</span></a>
                    @endif
                </div>
            </div>

            <div class="calc-start-image">
                <img src="/images/guia-abrir-cnpj.jpg" alt="Guia Completo para Abrir Empresa CNPJ no Brasil" class="calc-start-img" width="460" height="345" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- 11. CONTEÚDOS QUE PODEM INTERESSAR VOCÊ (BLOG COM FOTOS REAIS) -->
<section class="calc-blog-section">
    <div class="container" data-reveal>
        <div class="calc-section-head">
            <span class="eyebrow">ARTIGOS E GUIAS PRÁTICOS</span>
            <h2>Conteúdos que podem interessar você</h2>
            <p>Artigos detalhados preparados por nossos contadores para você gerenciar sua empresa com inteligência:</p>
        </div>

        <div class="calc-blog-grid">
            <a class="calc-blog-card" href="/blog">
                <img src="/images/contabilidade.jpeg" alt="Guia completo para abrir CNPJ sem erros" class="calc-blog-thumb" loading="lazy">
                <div class="calc-blog-body">
                    <span class="calc-blog-category">Abertura de Empresa</span>
                    <h3>Como abrir CNPJ em 2026: Guia passo a passo completo sem erros</h3>
                    <p>Descubra como formalizar sua atividade de forma 100% digital, escolher o CNAE correto e começar a emitir notas fiscais sem enfrentar filas.</p>
                    <span class="calc-blog-author">Equipe Contábil Cotech • 5 min de leitura</span>
                </div>
            </a>

            <a class="calc-blog-card" href="/blog">
                <img src="/images/planejamento.jpeg" alt="Simples Nacional ou Lucro Presumido" class="calc-blog-thumb" loading="lazy">
                <div class="calc-blog-body">
                    <span class="calc-blog-category">Simples Nacional</span>
                    <h3>Simples Nacional ou Lucro Presumido: Qual o melhor regime tributário?</h3>
                    <p>Entenda quando compensa optar pelo Simples Nacional e quando o Lucro Presumido pode ser uma escolha mais estratégica para pagar menos impostos.</p>
                    <span class="calc-blog-author">Equipe Contábil Cotech • 6 min de leitura</span>
                </div>
            </a>

            <a class="calc-blog-card" href="/blog">
                <img src="/images/contadores.jpeg" alt="Custos ocultos para manter uma empresa" class="calc-blog-thumb" loading="lazy">
                <div class="calc-blog-body">
                    <span class="calc-blog-category">Gestão & Tributos</span>
                    <h3>Quanto custa manter uma empresa aberta por mês? Custos e taxas reais</h3>
                    <p>Conheça todos os gastos fixos e variáveis de uma empresa prestadora de serviços e como manter as contas fiscais sempre em dia com baixo investimento.</p>
                    <span class="calc-blog-author">Equipe Contábil Cotech • 4 min de leitura</span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- 12. PERGUNTAS FREQUENTES (FAQ ACCORDION) -->
<section class="section calc-faq-section" id="faq">
    <div class="container" data-reveal>
        <div class="calc-section-head">
            <span class="eyebrow">DÚVIDAS FREQUENTES</span>
            <h2>Perguntas frequentes sobre abertura de CNPJ</h2>
            <p>Tudo o que você precisa saber sobre prazos, custos, documentação e funcionamento com a Cotech:</p>
        </div>

        <div class="faq-accordion-list" style="margin: 0 auto;">
            <details class="faq-item" open>
                <summary>Quanto tempo demora para meu CNPJ ficar pronto?</summary>
                <div class="faq-answer">
                    <p>Com a digitalização das Juntas Comerciais em quase todos os estados brasileiros, o processo de emissão do CNPJ pela Cotech costuma levar entre <strong>3 a 10 dias úteis</strong>, dependendo da agilidade de análise dos órgãos estaduais e da prefeitura local.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>A Cotech realmente não cobra honorários para abrir minha empresa?</summary>
                <div class="faq-answer">
                    <p>Exatamente! Nossos honorários profissionais de abertura são <strong>100% gratuitos</strong> para clientes que contratam qualquer plano de contabilidade mensal da Cotech. Você arca unicamente com as taxas oficiais cobradas pelo governo do seu estado (Junta Comercial) e prefeitura.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Posso abrir meu CNPJ usando meu endereço residencial?</summary>
                <div class="faq-answer">
                    <p>Sim! Para atividades de prestação de serviços intelectuais, desenvolvimento de software, consultoria, marketing e negócios digitais que não exigem estoque físico nem atendimento presencial ao público, a esmagadora maioria das prefeituras brasileiras autoriza o uso do endereço residencial como ponto de referência fiscal.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Qual a diferença entre abrir como MEI ou como Microempresa (ME)?</summary>
                <div class="faq-answer">
                    <p>O <strong>MEI</strong> é restrito a atividades operacionais básicas e tem teto de faturamento de R$ 81.000/ano. Já a <strong>Microempresa (ME)</strong> permite qualquer profissão intelectual (programadores, consultores, médicos, engenheiros), pode faturar até R$ 360 mil/ano (e até R$ 4,8 milhões como EPP no Simples Nacional) e oferece proteção aos bens pessoais dos sócios através da SLU.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Preciso de capital social mínimo para abrir uma Sociedade Limitada Unipessoal (SLU)?</summary>
                <div class="faq-answer">
                    <p>Não! Desde que a SLU substituiu a antiga EIRELI, não existe mais exigência de capital social mínimo de 100 salários mínimos. Você pode constituir sua empresa com qualquer capital simbólico inicial (como R$ 1.000 ou R$ 5.000), sem necessidade de comprovar o depósito em conta.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>O que acontece se eu já tiver um emprego CLT e abrir um CNPJ?</summary>
                <div class="faq-answer">
                    <p>Não há qualquer impedimento legal no Brasil para quem trabalha como CLT ser sócio ou titular de uma empresa PJ, exceto para servidores públicos com dedicação exclusiva ou casos de cláusula de não-concorrência no mesmo nicho direto. Seus direitos de carteira assinada continuam intactos.</p>
                </div>
            </details>
        </div>
    </div>
</section>

<!-- 13. BANNER FINAL: INVISTA AGORA NO SUCESSO -->
<section class="calc-invest-banner-section">
    <div class="container" data-reveal>
        <div class="calc-invest-banner-card">
            <h2>Invista agora no sucesso da sua empresa</h2>
            <p>Dê o primeiro passo com segurança, transparência e o apoio de um time contábil especialista. Abra seu CNPJ com honorários grátis e tenha tudo pronto para emitir notas e faturar.</p>
            <div class="calc-invest-actions">
                <a class="button blue-button" href="/orcamento?servico=abrir-cnpj">Quero Abrir Meu CNPJ Grátis <span>↗</span></a>
                @if($wa = \App\Support\Company::whatsapp())
                <a class="button srv-button-ghost" href="{{ $wa }}" target="_blank" rel="noopener">Conversar pelo WhatsApp <span>↗</span></a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- JAVASCRIPT ESPECÍFICO DO CÁLCULO E DAS ABAS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. TABELA DE TAXAS REAIS DAS JUNTAS COMERCIAIS
    const taxasEstados = {
        'SP': { junta: 202, alvara: 0, nome: 'São Paulo (SP) — JUCESP' },
        'RJ': { junta: 454, alvara: 120, nome: 'Rio de Janeiro (RJ) — JUCERJA' },
        'MG': { junta: 232, alvara: 0, nome: 'Minas Gerais (MG) — JUCEMG' },
        'PR': { junta: 168, alvara: 0, nome: 'Paraná (PR) — JUCEPAR' },
        'RS': { junta: 180, alvara: 0, nome: 'Rio Grande do Sul (RS) — JUCISRS' },
        'SC': { junta: 175, alvara: 0, nome: 'Santa Catarina (SC) — JUCESC' },
        'BA': { junta: 260, alvara: 150, nome: 'Bahia (BA) — JUCEB' },
        'PE': { junta: 270, alvara: 90, nome: 'Pernambuco (PE) — JUCEPE' },
        'CE': { junta: 210, alvara: 80, nome: 'Ceará (CE) — JUCEC' },
        'DF': { junta: 195, alvara: 0, nome: 'Distrito Federal (DF) — JUCIS-DF' },
        'GO': { junta: 240, alvara: 70, nome: 'Goiás (GO) — JUCEG' },
        'OUTRO': { junta: 250, alvara: 100, nome: 'Outros Estados' }
    };

    const selUf = document.getElementById('cnpj-uf');
    const selTipo = document.getElementById('cnpj-tipo');
    const selAtiv = document.getElementById('cnpj-atividade');
    const chkCert = document.getElementById('cnpj-tem-certificado');
    const btnCalc = document.getElementById('btn-calc-cnpj');

    function calcular() {
        const uf = selUf ? selUf.value : 'SP';
        const tipo = selTipo ? selTipo.value : 'SLU';
        const ativ = selAtiv ? selAtiv.value : 'servico';
        const incluirCert = chkCert ? chkCert.checked : true;

        const infoUf = taxasEstados[uf] || taxasEstados['OUTRO'];
        let juntaVal = infoUf.junta;
        if (tipo === 'LTDA') juntaVal += 45;
        if (tipo === 'EI') juntaVal = Math.max(90, juntaVal - 50);

        let alvaraVal = infoUf.alvara;
        if (ativ === 'servico' && (uf === 'SP' || uf === 'PR' || uf === 'MG' || uf === 'RS' || uf === 'SC' || uf === 'DF')) {
            alvaraVal = 0;
        }

        const certVal = incluirCert ? 179 : 0;
        const totalTaxas = juntaVal + alvaraVal + certVal;
        const custoTradicional = 1500;

        const fmt = val => 'R$ ' + val.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        const elJunta = document.getElementById('res-cnpj-junta');
        const elAlvara = document.getElementById('res-cnpj-alvara');
        const elCert = document.getElementById('res-cnpj-cert');
        const elTotal = document.getElementById('res-cnpj-total');
        const elTradicional = document.getElementById('res-cnpj-tradicional');
        const elEconomia = document.getElementById('res-cnpj-economia');

        if (elJunta) elJunta.textContent = fmt(juntaVal);
        if (elAlvara) elAlvara.textContent = alvaraVal === 0 ? 'R$ 0,00 (Isento)' : fmt(alvaraVal);
        if (elCert) elCert.textContent = incluirCert ? fmt(certVal) : 'R$ 0,00 (Não incluído)';
        if (elTotal) elTotal.textContent = fmt(totalTaxas);
        if (elTradicional) elTradicional.textContent = fmt(custoTradicional);
        if (elEconomia) elEconomia.textContent = fmt(custoTradicional);

        const ctaLink = document.getElementById('cnpj-cta-link');
        if (ctaLink) {
            ctaLink.href = `/orcamento?servico=abrir-cnpj&uf=${encodeURIComponent(uf)}&tipo=${encodeURIComponent(tipo)}`;
        }
    }

    btnCalc?.addEventListener('click', calcular);
    selUf?.addEventListener('change', calcular);
    selTipo?.addEventListener('change', calcular);
    selAtiv?.addEventListener('change', calcular);
    chkCert?.addEventListener('change', calcular);

    calcular();

    // 2. SWITCHER DE ABAS DE INFORMAÇÕES IMPORTANTES
    const tabBtns = document.querySelectorAll('.calc-info-tab-btn');
    const tabContents = document.querySelectorAll('.calc-info-tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-tab');

            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            this.classList.add('active');
            const targetContent = document.getElementById(targetId);
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });
});
</script>
@endsection
