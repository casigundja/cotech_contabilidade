<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\LeadStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ([['Novo',10,'#4263eb',null],['Em contato',20,'#0c8599',null],['Proposta enviada',30,'#e67700',null],['Ganho',90,'#2b8a3e','won'],['Perdido',100,'#c92a2a','lost']] as [$name,$sort,$color,$outcome]) {
            LeadStatus::firstOrCreate(['name'=>$name],compact('sort','color','outcome'));
        }
        foreach ([
            'name'=>'Cotech',
            'hero_title'=>'O próximo passo do seu negócio começa aqui.',
            'hero_text'=>'Transformamos números em direção. Contabilidade e consultoria próximas de você, com foco no que o seu negócio precisa para avançar.',
            'footer'=>'Conhecimento, proximidade e soluções para transformar o futuro do seu negócio.',
        ] as $key=>$value) DB::table('settings')->insertOrIgnore(compact('key','value'));
        $items = [
            ['service','Contabilidade empresarial','contabilidade-empresarial','Organização contábil para entender os números e apoiar as decisões da sua empresa.','Acompanhamos a organização das informações contábeis do seu negócio, ajudando você a compreender resultados e manter uma visão clara da operação. Converse com a equipe para definirmos o escopo adequado à sua empresa.','/images/contabilidade.jpeg'],
            ['service','Planejamento e gestão','planejamento-e-gestao','Mais clareza sobre metas, recursos e os próximos passos do seu negócio.','Apoiamos a estruturação de objetivos, a organização de informações e o acompanhamento de indicadores. O trabalho começa com uma análise das necessidades do seu negócio e uma proposta personalizada.','/images/planejamento.jpeg'],
            ['service','Consultoria empresarial','consultoria-empresarial','Um olhar próximo para transformar desafios em um plano de ação.','Ouvimos sua equipe, compreendemos o momento da empresa e ajudamos a organizar prioridades. Construímos juntos um caminho de melhoria para sua gestão e seus processos.','/images/contadores.jpeg'],
            ['service','🏢 Abertura e regularização de empresas','abertura-e-regularizacao-de-empresas','Abertura ágil de empresas, regularização cadastral, emissão de alvarás e alterações contratuais sem burocracia.','Cuidamos de todas as etapas burocráticas para formalizar ou regularizar o seu negócio junto aos órgãos públicos (Receita Federal, Junta Comercial, Prefeitura e órgãos de classe). Realizamos desde a consulta de viabilidade de endereço e nome empresarial até a obtenção de alvarás, licenças e regularização de pendências cadastrais ou fiscais. Conte com a orientação da Cotech para iniciar suas atividades com segurança jurídica e no melhor regime tributário.','/images/cotech-abrir-empresa.jpg'],
            ['service','Abertura de CNPJ','abertura-de-cnpj','Abra seu CNPJ com rapidez, suporte contábil completo e escolha do enquadramento tributário mais econômico.','Tenha o seu CNPJ ativo com agilidade e total conformidade. Analisamos detalhadamente a sua atividade (CNAE) para enquadrar sua empresa no modelo societário mais vantajoso (SLU, LTDA ou Empresário Individual) e na melhor tributação (Simples Nacional, Lucro Presumido ou Lucro Real). Nossa equipe acompanha todo o processo até a liberação para emissão de notas fiscais.','/images/guia-abrir-cnpj.jpg'],
            ['service','💰 Consultoria tributária e financeira','consultoria-tributaria-e-financeira','Planejamento tributário estratégico, redução legal de impostos, fluxo de caixa e gestão financeira para o seu crescimento.','Transforme seus números em decisões estratégicas. Nossa consultoria tributária analisa as particularidades do seu faturamento para identificar oportunidades de economia fiscal dentro da lei, recuperação de créditos e prevenção de riscos. Na gestão financeira, apoiamos a estruturação de fluxo de caixa, precificação de serviços e produtos e relatórios gerenciais para potencializar a rentabilidade do seu negócio.','/images/planejamento.jpeg'],
            ['service','👥 Departamento pessoal / RH','departamento-pessoal-rh','Gestão completa de folha de pagamento, admissões, rescisões, eSocial e cumprimento rigoroso das rotinas trabalhistas.','Tenha tranquilidade na gestão da sua equipe. Cuidamos de todo o processamento de folha de pagamento, cálculo de férias, 13º salário, rescisões, benefícios e pró-labore dos sócios. Mantemos sua empresa em total conformidade com o eSocial, FGTS Digital e a legislação trabalhista vigente, evitando passivos e garantindo uma relação saudável com seus colaboradores.','/images/contadores.jpeg'],
            ['service','👤 Serviços para pessoa física','servicos-para-pessoa-fisica','Declaração de Imposto de Renda (IRPF), regularização de CPF, apuração de ganho de capital e assessoria para profissionais autônomos.','Suporte especializado para cuidar do seu patrimônio pessoal. Elaboramos e transmitimos a sua Declaração de Ajuste Anual do IRPF com foco na dedução correta e na prevenção de malha fina. Atendemos também autônomos e profissionais liberais com a emissão do Carnê-Leão, cálculo do recolhimento mensal obrigatório e planejamento para transição de PF para PJ quando mais vantajoso.','/images/contabilidade.jpeg'],
            ['service','🧾 Serviços para MEIA','servicos-para-mei','Abertura, regularização do DASN-SIMEI, parcelamento de débitos, desenquadramento para ME e assessoria mensal para microempreendedores.','Atendimento sob medida para o Microempreendedor Individual (MEI). Apoiamos a formalização do MEI, emissão de guias DAS mensais, entrega da Declaração Anual (DASN-SIMEI) e parcelamento de pendências fiscais. E quando o seu faturamento ultrapassar o limite ou você precisar contratar mais colaboradores, realizamos a transição segura e planejada de MEI para Microempresa (ME).','/images/cotech-abrir-empresa.jpg'],
            ['team','Fernando Kiosa','fernando-kiosa','CEO','','/images/fernando.png'],
            ['team','Francisco Calombe','francisco-calombe','Sócio','','/images/francisco.jpg'],
            ['faq','Como solicitar uma proposta?','como-solicitar-proposta','','Preencha o formulário com seus dados e uma breve descrição do que precisa. Nossa equipe analisará a solicitação e entrará em contato pelo canal escolhido.',null],
            ['faq','Posso enviar documentos para avaliação?','enviar-documentos','','Sim. O formulário aceita até cinco arquivos de imagem ou PDF, com tamanho máximo de 5 MB por arquivo. Envie somente documentos necessários à sua solicitação.',null],
            ['faq','Ainda não sei qual serviço preciso. Como começar?','como-comecar','','Selecione “Preciso de orientação” no formulário e conte um pouco sobre seu negócio. A primeira conversa nos ajuda a entender como podemos apoiar você.',null],
            ['post','Mais clareza para as decisões do seu negócio','clareza-nas-decisoes','Organizar informações é o primeiro passo para planejar com confiança.','Uma visão organizada das receitas, despesas e compromissos ajuda a compreender o momento do negócio. Reserve uma rotina para revisar as informações, acompanhar o que mudou e registrar as principais decisões. A equipe da Cotech pode ajudar você a organizar esse processo de acordo com a realidade da sua empresa.','/images/contabilidade.jpeg'],
            ['post','Planejar é preparar o próximo passo','preparar-o-proximo-passo','Metas claras ajudam a transformar intenções em ações acompanháveis.','Comece identificando as prioridades do seu negócio. Para cada objetivo, registre as ações necessárias, os responsáveis e uma data de acompanhamento. Revise o plano regularmente e ajuste o caminho conforme aprende com a operação.','/images/planejamento.jpeg'],
            ['post','Uma parceria que começa pela escuta','parceria-pela-escuta','Entender o contexto faz parte de construir uma boa solução.','Antes de definir um plano de trabalho, é preciso conhecer a empresa, as pessoas e os desafios que elas enfrentam. Na Cotech, a conversa inicial é um espaço para apresentar necessidades, esclarecer expectativas e construir uma proposta adequada.','/images/contadores.jpeg'],
            ['page','Privacidade e uso de dados','privacidade','Como tratamos as informações enviadas pelo site.',"Usamos os dados enviados no formulário para analisar e atender sua solicitação, entrar em contato e acompanhar o relacionamento comercial.\n\nPodemos receber nome, telefone, e-mail, dados da empresa, cidade, mensagem e os anexos que você decidir enviar. Também registramos a origem da visita e o consentimento associado à solicitação.\n\nOs anexos ficam em armazenamento privado, acessíveis à equipe autorizada. O site utiliza cookies de sessão necessários ao funcionamento dos formulários e do acesso da equipe.\n\nPara solicitar informações, correção ou exclusão dos seus dados, entre em contato pelo formulário do site, identificando o pedido na mensagem. Não envie documentos ou dados sensíveis desnecessários ao atendimento.",null],
        ];
        foreach ($items as $sort=>[$type,$title,$slug,$summary,$body,$image]) {
            Content::firstOrCreate(['slug'=>$slug],compact('type','title','summary','body','image','sort')+['active'=>true,'published_at'=>now()]);
        }
        Cache::forget('company');
    }
}
