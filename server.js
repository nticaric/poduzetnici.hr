const express = require('express');
const path = require('path');
const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(express.static('public'));

// In-memory data storage (in a real app, this would be a database)
let entrepreneurs = [];
let services = [];
let resources = [];

// API Routes

// Get all entrepreneurs
app.get('/api/entrepreneurs', (req, res) => {
  res.json(entrepreneurs);
});

// Add a new entrepreneur
app.post('/api/entrepreneurs', (req, res) => {
  const entrepreneur = {
    id: entrepreneurs.length + 1,
    name: req.body.name,
    email: req.body.email,
    business: req.body.business,
    description: req.body.description,
    location: req.body.location,
    createdAt: new Date()
  };
  entrepreneurs.push(entrepreneur);
  res.status(201).json(entrepreneur);
});

// Search entrepreneurs
app.get('/api/entrepreneurs/search', (req, res) => {
  const { query } = req.query;
  if (!query) {
    return res.json(entrepreneurs);
  }
  
  const results = entrepreneurs.filter(e => 
    e.name.toLowerCase().includes(query.toLowerCase()) ||
    e.business.toLowerCase().includes(query.toLowerCase()) ||
    e.description.toLowerCase().includes(query.toLowerCase()) ||
    e.location.toLowerCase().includes(query.toLowerCase())
  );
  res.json(results);
});

// Get all services
app.get('/api/services', (req, res) => {
  res.json(services);
});

// Add a new service
app.post('/api/services', (req, res) => {
  const service = {
    id: services.length + 1,
    title: req.body.title,
    description: req.body.description,
    provider: req.body.provider,
    category: req.body.category,
    contact: req.body.contact,
    createdAt: new Date()
  };
  services.push(service);
  res.status(201).json(service);
});

// Get all resources
app.get('/api/resources', (req, res) => {
  res.json(resources);
});

// Add a new resource
app.post('/api/resources', (req, res) => {
  const resource = {
    id: resources.length + 1,
    title: req.body.title,
    description: req.body.description,
    type: req.body.type,
    url: req.body.url,
    createdAt: new Date()
  };
  resources.push(resource);
  res.status(201).json(resource);
});

// Serve the main page
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// Start server
app.listen(PORT, () => {
  console.log(`Poduzetnici.hr server running on http://localhost:${PORT}`);
});

module.exports = app;
