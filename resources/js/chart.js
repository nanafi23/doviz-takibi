/**
 * Charts.js - Chart initialization and data functions
 * 
 * This file contains functions for initializing and updating charts
 * used in the dashboard and currency pages.
 */

// Initialize currency trends chart
function initCurrencyTrendsChart(chartId, data) {
  const ctx = document.getElementById(chartId);
  if (!ctx) return null;
  
  return new Chart(ctx, {
    type: 'line',
    data: {
      labels: data.labels || [],
      datasets: data.datasets || []
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'top',
        },
        tooltip: {
          mode: 'index',
          intersect: false
        }
      },
      scales: {
        y: {
          beginAtZero: false,
          grid: {
            display: true
          }
        },
        x: {
          grid: {
            display: false
          }
        }
      }
    }
  });
}

// Initialize conversion distribution chart
function initConversionDistributionChart(chartId, data) {
  const ctx = document.getElementById(chartId);
  if (!ctx) return null;
  
  return new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: data.labels || [],
      datasets: data.datasets || []
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'right',
        }
      }
    }
  });
}

// Get currency trends chart data
function getCurrencyTrendsData() {
  // This would typically come from an API
  return {
    labels: ['1 Oca', '15 Oca', '1 Şub', '15 Şub', '1 Mar', '15 Mar', '1 Nis', '15 Nis', '1 May', '15 May', '1 Haz'],
    datasets: [
      {
        label: 'USD/TRY',
        data: [27.5, 27.8, 28.2, 28.5, 28.7, 29.0, 29.2, 29.4, 29.6, 29.7, 29.8],
        borderColor: 'rgba(59, 130, 246, 1)',
        backgroundColor: 'rgba(59, 130, 246, 0.1)',
        borderWidth: 2,
        fill: true,
        tension: 0.4
      },
      {
        label: 'EUR/TRY',
        data: [30.1, 30.4, 30.7, 31.0, 31.3, 31.6, 31.8, 32.0, 32.2, 32.3, 32.4],
        borderColor: 'rgba(245, 158, 11, 1)',
        backgroundColor: 'rgba(245, 158, 11, 0.1)',
        borderWidth: 2,
        fill: true,
        tension: 0.4
      },
      {
        label: 'GBP/TRY',
        data: [35.2, 35.5, 35.8, 36.1, 36.4, 36.7, 37.0, 37.3, 37.6, 37.8, 38.0],
        borderColor: 'rgba(16, 185, 129, 1)',
        backgroundColor: 'rgba(16, 185, 129, 0.1)',
        borderWidth: 2,
        fill: true,
        tension: 0.4
      }
    ]
  };
}

// Get conversion distribution chart data
function getConversionDistributionData() {
  // This would typically come from an API
  return {
    labels: ['USD', 'EUR', 'GBP', 'JPY', 'Diğer'],
    datasets: [{
      data: [45, 25, 15, 10, 5],
      backgroundColor: [
        'rgba(59, 130, 246, 0.8)',
        'rgba(245, 158, 11, 0.8)',
        'rgba(16, 185, 129, 0.8)',
        'rgba(236, 72, 153, 0.8)',
        'rgba(107, 114, 128, 0.8)'
      ],
      borderColor: [
        'rgba(59, 130, 246, 1)',
        'rgba(245, 158, 11, 1)',
        'rgba(16, 185, 129, 1)',
        'rgba(236, 72, 153, 1)',
        'rgba(107, 114, 128, 1)'
      ],
      borderWidth: 1
    }]
  };
}

// Initialize dashboard charts
function initDashboardCharts() {
  // Currency trends chart
  initCurrencyTrendsChart('currencyTrendsChart', getCurrencyTrendsData());
  
  // Conversion distribution chart
  initConversionDistributionChart('conversionDistributionChart', getConversionDistributionData());
}

// Initialize historical rates chart for converter
function initHistoricalRatesChart(fromCurrency, toCurrency) {
  const ctx = document.getElementById('historicalRatesChart');
  if (!ctx) return null;
  
  // Generate some sample data based on the selected currencies
  const data = {
    labels: ['1 Oca', '15 Oca', '1 Şub', '15 Şub', '1 Mar', '15 Mar', '1 Nis', '15 Nis', '1 May', '15 May', '1 Haz'],
    datasets: [{
      label: `${fromCurrency}/${toCurrency} Kur Geçmişi`,
      data: Array.from({length: 11}, () => Math.random() * 5 + 25),
      borderColor: 'rgba(59, 130, 246, 1)',
      backgroundColor: 'rgba(59, 130, 246, 0.1)',
      borderWidth: 2,
      fill: true,
      tension: 0.4
    }]
  };
  
  return initCurrencyTrendsChart('historicalRatesChart', data);
}

// Update historical rates chart when currencies change
function updateHistoricalRatesChart(chart, fromCurrency, toCurrency) {
  if (!chart) return;
  
  // Update chart label
  chart.data.datasets[0].label = `${fromCurrency}/${toCurrency} Kur Geçmişi`;
  
  // Generate new random data
  chart.data.datasets[0].data = Array.from({length: 11}, () => Math.random() * 5 + 25);
  
  // Update chart
  chart.update();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
  // Initialize dashboard charts if on dashboard page
  if (document.getElementById('currencyTrendsChart') && document.getElementById('conversionDistributionChart')) {
    initDashboardCharts();
  }
  
  // Initialize historical rates chart if on converter page
  if (document.getElementById('historicalRatesChart')) {
    const fromCurrencySelect = document.getElementById('from-currency');
    const toCurrencySelect = document.getElementById('to-currency');
    
    if (fromCurrencySelect && toCurrencySelect) {
      const fromCurrency = fromCurrencySelect.value;
      const toCurrency = toCurrencySelect.value;
      
      const chart = initHistoricalRatesChart(fromCurrency, toCurrency);
      
      // Update chart when currencies change
      fromCurrencySelect.addEventListener('change', function() {
        updateHistoricalRatesChart(chart, this.value, toCurrencySelect.value);
      });
      
      toCurrencySelect.addEventListener('change', function() {
        updateHistoricalRatesChart(chart, fromCurrencySelect.value, this.value);
      });
    }
  }
});
