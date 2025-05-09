## Visão Geral
Este documento fornece uma documentação detalhada do site WordPress com tema personalizado "DataInsight" ( um projeto que ainda nao conseguir upar) focado em visualização de dados. O projeto demonstra habilidades em desenvolvimento WordPress, PHP, e integração de bibliotecas JavaScript para visualização de dados.

## Estrutura do Projeto
```
wordpress/
├── public_html/                                # Raiz do WordPress
│   └── wp-content/
│       └── themes/
│           └── datainsight/                    # Tema personalizado
│               ├── functions.php               # Funcionalidades do tema
│               ├── style.css                   # Estilos do tema
│               ├── header.php                  # Template do cabeçalho
│               ├── footer.php                  # Template do rodapé
│               ├── page.php                    # Template de página
│               ├── archive-data_visualization.php  # Template de arquivo
│               ├── single-data_visualization.php   # Template de post único
│               └── js/
│                   └── main.js                 # JavaScript do tema
└── wordpress.conf                              # Configuração do Virtual Host
```

## Tecnologias Utilizadas
- **WordPress**: Sistema de gerenciamento de conteúdo
- **PHP**: Linguagem de programação para desenvolvimento do tema
- **MySQL**: Banco de dados para armazenamento de conteúdo
- **Apache**: Servidor web
- **HTML/CSS**: Estrutura e estilização do tema
- **JavaScript**: Interatividade e visualizações
- **Chart.js**: Biblioteca para criação de gráficos

## Funcionalidades Detalhadas

### 1. Tema Personalizado "DataInsight"
Um tema WordPress completo com:
- Estrutura semântica e responsiva
- Suporte a menus de navegação personalizáveis
- Áreas de widgets para sidebar e rodapé
- Suporte a imagens destacadas e logotipo personalizado
- Estilização moderna e profissional

### 2. Tipo de Post Personalizado para Visualizações
Implementação de um Custom Post Type (CPT) "data_visualization" que:
- Possui interface administrativa personalizada
- Inclui suporte a imagens destacadas e campos personalizados
- Possui templates específicos para listagem e visualização individual
- Permite categorização e organização das visualizações

### 3. Campos Personalizados para Gráficos
Meta boxes personalizadas que permitem:
- Seleção do tipo de gráfico (barras, linha, pizza, rosca)
- Entrada de dados em formato JSON para configuração do gráfico
- Validação e sanitização de dados
- Armazenamento seguro no banco de dados WordPress

### 4. Shortcode para Inserção de Gráficos
Implementação de shortcode `[datainsight_chart]` que:
- Permite inserção de gráficos em qualquer página ou post
- Aceita parâmetro de ID para referenciar a visualização
- Renderiza o gráfico usando Chart.js
- Aplica configurações responsivas automaticamente

### 5. Integração com Chart.js
Integração completa com a biblioteca Chart.js para:
- Renderização de diferentes tipos de gráficos
- Configurações responsivas para diferentes dispositivos
- Interatividade com tooltips e legendas
- Personalização de cores e estilos

## Implementação Técnica

### Configuração do WordPress
O WordPress foi configurado em um ambiente simulando VPS com:
- Apache como servidor web
- MySQL/MariaDB como banco de dados
- PHP 8.1 com módulos necessários
- Virtual Host configurado para acesso via domínio personalizado

### Desenvolvimento do Tema

#### functions.php
O arquivo principal do tema que implementa:
- Registro de menus de navegação
- Configuração de suporte a recursos do tema (thumbnails, HTML5, etc.)
- Carregamento de scripts e estilos
- Registro de áreas de widgets
- Registro do tipo de post personalizado "data_visualization"
- Implementação de campos personalizados (meta boxes)
- Criação do shortcode para visualizações

#### Templates
Conjunto de templates que definem a estrutura e apresentação:
- **header.php**: Cabeçalho do site com logo e menu
- **footer.php**: Rodapé com widgets e informações de copyright
- **page.php**: Template para páginas regulares
- **archive-data_visualization.php**: Template para listagem de visualizações
- **single-data_visualization.php**: Template para visualização individual

#### Estilização
O arquivo `style.css` implementa:
- Design responsivo para todos os dispositivos
- Sistema de grid para layout flexível
- Estilos específicos para visualizações de dados
- Tipografia e esquema de cores consistentes
- Animações e transições para melhor experiência do usuário

#### JavaScript
O arquivo `main.js` contém:
- Inicialização de componentes interativos
- Funções para exportação de dados de gráficos
- Funções para atualização de visualizações em tempo real
- Melhorias de acessibilidade e usabilidade

### Tipo de Post Personalizado
O CPT "data_visualization" foi implementado com:
- Labels personalizados para a interface administrativa
- Suporte a recursos como editor, imagens destacadas e campos personalizados
- Taxonomias para categorização
- Slug personalizado para URLs amigáveis
- Suporte a REST API para integração com outras aplicações

### Campos Personalizados
Os campos personalizados para gráficos incluem:
- Seletor de tipo de gráfico (dropdown)
- Campo de texto para dados JSON
- Validação e sanitização de entrada
- Armazenamento seguro como post meta
- Interface administrativa intuitiva

### Shortcode
O shortcode `[datainsight_chart]` implementa:
- Parsing de atributos para identificar a visualização
- Recuperação de dados do post meta
- Renderização do gráfico usando Chart.js
- Configurações responsivas automáticas

## Configuração do Servidor

### Virtual Host Apache
Configuração de Virtual Host que:
- Define o DocumentRoot para o diretório WordPress
- Configura permissões apropriadas
- Habilita rewrite rules para URLs amigáveis
- Configura logs de erro e acesso

### Banco de Dados
Configuração do MySQL/MariaDB com:
- Banco de dados dedicado para o WordPress
- Usuário com privilégios apropriados
- Configurações de segurança básicas

### Permissões de Arquivos
Configuração de permissões que:
- Garante segurança dos arquivos do WordPress
- Permite atualizações e uploads pelo WordPress
- Segue as melhores práticas de segurança

## Possíveis Melhorias Futuras
- Implementação de mais tipos de visualização
- Integração com fontes de dados externas via API
- Sistema de cache para melhor desempenho
- Funcionalidades de exportação de dados
- Painel administrativo personalizado para análise de dados
- Suporte a múltiplos idiomas

## Guia de Uso

### Administração do WordPress
1. Acesse o painel administrativo em `/wp-admin`
2. Use as credenciais fornecidas para login
3. Navegue até "Visualizações" para gerenciar as visualizações de dados

### Criação de Visualizações
1. No painel administrativo, vá para "Visualizações" > "Adicionar Nova"
2. Preencha o título e descrição da visualização
3. No box "Dados do Gráfico", selecione o tipo de gráfico
4. Insira os dados JSON no formato especificado
5. Publique a visualização

### Inserção de Gráficos em Páginas
1. Edite qualquer página ou post
2. Use o shortcode `[datainsight_chart id="X"]` onde X é o ID da visualização
3. Atualize ou publique a página
4. Visualize a página para ver o gráfico renderizado
