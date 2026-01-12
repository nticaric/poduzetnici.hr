// Tab switching
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab
    document.getElementById(`${tabName}-tab`).classList.add('active');
    event.target.classList.add('active');
    
    // Load data for the selected tab
    if (tabName === 'entrepreneurs') {
        loadEntrepreneurs();
    } else if (tabName === 'services') {
        loadServices();
    } else if (tabName === 'resources') {
        loadResources();
    }
}

// Entrepreneurs functionality
function showAddEntrepreneurForm() {
    document.getElementById('add-entrepreneur-form').style.display = 'block';
}

function hideAddEntrepreneurForm() {
    document.getElementById('add-entrepreneur-form').style.display = 'none';
    document.querySelector('#add-entrepreneur-form form').reset();
}

async function addEntrepreneur(event) {
    event.preventDefault();
    
    const entrepreneur = {
        name: document.getElementById('entrepreneur-name').value,
        email: document.getElementById('entrepreneur-email').value,
        business: document.getElementById('entrepreneur-business').value,
        location: document.getElementById('entrepreneur-location').value,
        description: document.getElementById('entrepreneur-description').value
    };
    
    try {
        const response = await fetch('/api/entrepreneurs', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(entrepreneur)
        });
        
        if (response.ok) {
            hideAddEntrepreneurForm();
            loadEntrepreneurs();
        }
    } catch (error) {
        console.error('Error adding entrepreneur:', error);
    }
}

async function loadEntrepreneurs() {
    try {
        const response = await fetch('/api/entrepreneurs');
        const entrepreneurs = await response.json();
        displayEntrepreneurs(entrepreneurs);
    } catch (error) {
        console.error('Error loading entrepreneurs:', error);
    }
}

function displayEntrepreneurs(entrepreneurs) {
    const container = document.getElementById('entrepreneurs-list');
    
    if (entrepreneurs.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #999; padding: 2rem;">Još nema dodanih poduzetnika. Budite prvi!</p>';
        return;
    }
    
    container.innerHTML = entrepreneurs.map(e => `
        <div class="card">
            <h3>${e.name}</h3>
            <div class="meta">📍 ${e.location} | 💼 ${e.business}</div>
            <div class="description">${e.description}</div>
            <div class="badge">📧 ${e.email}</div>
        </div>
    `).join('');
}

async function searchEntrepreneurs() {
    const query = document.getElementById('search-entrepreneurs').value;
    
    try {
        const response = await fetch(`/api/entrepreneurs/search?query=${encodeURIComponent(query)}`);
        const results = await response.json();
        displayEntrepreneurs(results);
    } catch (error) {
        console.error('Error searching entrepreneurs:', error);
    }
}

// Services functionality
function showAddServiceForm() {
    document.getElementById('add-service-form').style.display = 'block';
}

function hideAddServiceForm() {
    document.getElementById('add-service-form').style.display = 'none';
    document.querySelector('#add-service-form form').reset();
}

async function addService(event) {
    event.preventDefault();
    
    const service = {
        title: document.getElementById('service-title').value,
        provider: document.getElementById('service-provider').value,
        category: document.getElementById('service-category').value,
        contact: document.getElementById('service-contact').value,
        description: document.getElementById('service-description').value
    };
    
    try {
        const response = await fetch('/api/services', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(service)
        });
        
        if (response.ok) {
            hideAddServiceForm();
            loadServices();
        }
    } catch (error) {
        console.error('Error adding service:', error);
    }
}

async function loadServices() {
    try {
        const response = await fetch('/api/services');
        const services = await response.json();
        displayServices(services);
    } catch (error) {
        console.error('Error loading services:', error);
    }
}

function displayServices(services) {
    const container = document.getElementById('services-list');
    
    if (services.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #999; padding: 2rem;">Još nema dodanih usluga. Budite prvi!</p>';
        return;
    }
    
    container.innerHTML = services.map(s => `
        <div class="card">
            <h3>${s.title}</h3>
            <div class="meta">👤 ${s.provider} | 📂 ${s.category}</div>
            <div class="description">${s.description}</div>
            <div class="badge">📞 ${s.contact}</div>
        </div>
    `).join('');
}

// Resources functionality
function showAddResourceForm() {
    document.getElementById('add-resource-form').style.display = 'block';
}

function hideAddResourceForm() {
    document.getElementById('add-resource-form').style.display = 'none';
    document.querySelector('#add-resource-form form').reset();
}

async function addResource(event) {
    event.preventDefault();
    
    const resource = {
        title: document.getElementById('resource-title').value,
        type: document.getElementById('resource-type').value,
        url: document.getElementById('resource-url').value,
        description: document.getElementById('resource-description').value
    };
    
    try {
        const response = await fetch('/api/resources', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(resource)
        });
        
        if (response.ok) {
            hideAddResourceForm();
            loadResources();
        }
    } catch (error) {
        console.error('Error adding resource:', error);
    }
}

async function loadResources() {
    try {
        const response = await fetch('/api/resources');
        const resources = await response.json();
        displayResources(resources);
    } catch (error) {
        console.error('Error loading resources:', error);
    }
}

function displayResources(resources) {
    const container = document.getElementById('resources-list');
    
    if (resources.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #999; padding: 2rem;">Još nema dodanih resursa. Budite prvi!</p>';
        return;
    }
    
    container.innerHTML = resources.map(r => `
        <div class="card">
            <h3>${r.title}</h3>
            <div class="meta">📁 ${r.type}</div>
            <div class="description">${r.description}</div>
            ${r.url ? `<div class="badge">🔗 <a href="${r.url}" target="_blank" style="color: #667eea; text-decoration: none;">Posjeti link</a></div>` : ''}
        </div>
    `).join('');
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    loadEntrepreneurs();
});
