// Currency.js - Utility functions for currency management

/**
 * Format a number as currency with the specified code
 * @param {number} amount - The amount to format
 * @param {string} currencyCode - The currency code (e.g., USD, EUR)
 * @param {string} locale - The locale to use for formatting (default: 'tr-TR')
 * @returns {string} Formatted currency string
 */
function formatCurrency(amount, currencyCode, locale = 'tr-TR') {
    return new Intl.NumberFormat(locale, {
        style: 'currency',
        currency: currencyCode,
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(amount);
}

/**
 * Convert an amount from one currency to another
 * @param {number} amount - The amount to convert
 * @param {number} fromRate - The exchange rate of the source currency
 * @param {number} toRate - The exchange rate of the target currency
 * @returns {number} The converted amount
 */
function convertCurrency(amount, fromRate, toRate) {
    // Convert to base currency (TRY) first, then to target currency
    return (amount * fromRate) / toRate;
}

/**
 * Calculate the percentage change between two values
 * @param {number} oldValue - The old value
 * @param {number} newValue - The new value
 * @returns {number} The percentage change
 */
function calculatePercentageChange(oldValue, newValue) {
    return ((newValue - oldValue) / oldValue) * 100;
}

/**
 * Get the flag emoji for a country code
 * @param {string} countryCode - The 2-letter country code
 * @returns {string} The flag emoji
 */
function getFlagEmoji(countryCode) {
    if (!countryCode) return '🏳️';
    
    // Convert country code to flag emoji
    const codePoints = countryCode
        .toUpperCase()
        .split('')
        .map(char => 127397 + char.charCodeAt(0));
    
    return String.fromCodePoint(...codePoints);
}

/**
 * Get popular currency pairs
 * @returns {Array} Array of popular currency pairs
 */
function getPopularCurrencyPairs() {
    return [
        { from: 'USD', to: 'TRY', name: 'Amerikan Doları / Türk Lirası' },
        { from: 'EUR', to: 'TRY', name: 'Euro / Türk Lirası' },
        { from: 'GBP', to: 'TRY', name: 'İngiliz Sterlini / Türk Lirası' },
        { from: 'USD', to: 'EUR', name: 'Amerikan Doları / Euro' },
        { from: 'EUR', to: 'USD', name: 'Euro / Amerikan Doları' },
        { from: 'GBP', to: 'USD', name: 'İngiliz Sterlini / Amerikan Doları' }
    ];
}

/**
 * Initialize currency charts
 * @param {string} elementId - The ID of the canvas element
 * @param {Array} labels - The labels for the x-axis
 * @param {Array} datasets - The datasets to display
 */
function initCurrencyChart(elementId, labels, datasets) {
    const ctx = document.getElementById(elementId).getContext('2d');
    
    return new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    grid: {
                        display: true,
                        drawBorder: false
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

/**
 * Save user preferences
 * @param {Object} preferences - The user preferences to save
 */
function saveUserPreferences(preferences) {
    localStorage.setItem('userPreferences', JSON.stringify(preferences));
}

/**
 * Get user preferences
 * @returns {Object} The user preferences
 */
function getUserPreferences() {
    const preferences = localStorage.getItem('userPreferences');
    return preferences ? JSON.parse(preferences) : {
        darkMode: false,
        favoriteCurrencies: [],
        defaultFromCurrency: 'USD',
        defaultToCurrency: 'TRY'
    };
}

/**
 * Toggle dark mode
 */
function toggleDarkMode() {
    const preferences = getUserPreferences();
    preferences.darkMode = !preferences.darkMode;
    saveUserPreferences(preferences);
    
    if (preferences.darkMode) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

/**
 * Initialize the application
 */
function initApp() {
    // Apply user preferences
    const preferences = getUserPreferences();
    
    if (preferences.darkMode) {
        document.documentElement.classList.add('dark');
        const themeToggle = document.getElementById('theme-toggle');
        if (themeToggle) {
            const icon = themeToggle.querySelector('i');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }
    }
    
    // Set up event listeners
    setupEventListeners();
}

/**
 * Set up event listeners
 */
function setupEventListeners() {
    // Theme toggle
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            toggleDarkMode();
            const icon = this.querySelector('i');
            if (document.documentElement.classList.contains('dark')) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });
    }
    
    // Dropdown menu toggle
    document.querySelectorAll('.relative button').forEach(button => {
        button.addEventListener('click', function() {
            const dropdown = this.closest('.relative').querySelector('.dropdown-menu');
            dropdown.classList.toggle('hidden');
        });
    });
    
    // Mobile sidebar toggle
    const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
    if (mobileSidebarToggle) {
        mobileSidebarToggle.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.dropdown-menu');
        dropdowns.forEach(dropdown => {
            if (!dropdown.closest('.relative')?.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
}

// Initialize the application when the DOM is loaded
document.addEventListener('DOMContentLoaded', initApp);
