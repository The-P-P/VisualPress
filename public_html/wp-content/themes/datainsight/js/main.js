// JavaScript principal para o tema DataInsight
jQuery(document).ready(function($) {
    // Inicializar tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Adicionar classe ativa ao item de menu atual
    $('.main-navigation a').each(function() {
        if ($(this).attr('href') === window.location.href) {
            $(this).addClass('active');
        }
    });
    
    // Animação suave para links de âncora
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });
    
    // Responsividade para tabelas
    $('.entry-content table').wrap('<div class="table-responsive"></div>');
    
    // Adicionar classe para imagens responsivas
    $('.entry-content img').addClass('img-fluid');
    
    // Inicializar carregamento lazy para imagens
    if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            img.src = img.dataset.src;
        });
    } else {
        // Fallback para navegadores que não suportam lazy loading
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
        document.body.appendChild(script);
    }
});

// Função para exportar dados de gráficos
function exportChartData(chartId, format) {
    const chart = Chart.getChart(chartId);
    if (!chart) return;
    
    const canvas = document.getElementById(chartId);
    
    if (format === 'png' || format === 'jpg') {
        // Exportar como imagem
        const link = document.createElement('a');
        link.download = 'chart-export.' + format;
        link.href = canvas.toDataURL('image/' + (format === 'jpg' ? 'jpeg' : 'png'));
        link.click();
    } else if (format === 'csv') {
        // Exportar como CSV
        let csvContent = 'data:text/csv;charset=utf-8,';
        
        // Adicionar cabeçalhos
        const labels = chart.data.labels;
        csvContent += 'Label,' + chart.data.datasets.map(ds => ds.label).join(',') + '\n';
        
        // Adicionar dados
        labels.forEach((label, i) => {
            csvContent += label + ',';
            csvContent += chart.data.datasets.map(ds => ds.data[i]).join(',') + '\n';
        });
        
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'chart-data.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}

// Função para atualizar visualizações em tempo real
function updateChartData(chartId, endpoint) {
    fetch(endpoint)
        .then(response => response.json())
        .then(data => {
            const chart = Chart.getChart(chartId);
            if (chart) {
                chart.data = data;
                chart.update();
            }
        })
        .catch(error => console.error('Erro ao atualizar dados:', error));
}
