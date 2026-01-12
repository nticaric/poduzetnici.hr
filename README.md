# Poduzetnici.hr 🚀

Poduzetnici.hr is a web platform designed to connect entrepreneurs in Croatia. It serves as a central hub for finding business partners, offering services, and seeking resources.

## Features

- **Find Business Partners**: Browse and search for entrepreneurs across Croatia
- **Offer Services**: List your professional services to connect with potential clients
- **Share Resources**: Discover and share useful resources for entrepreneurs
- **Search Functionality**: Find entrepreneurs by name, business type, location, or description

## Getting Started

### Prerequisites

- Node.js (v14 or higher)
- npm (Node Package Manager)

### Installation

1. Clone the repository:
```bash
git clone https://github.com/nticaric/poduzetnici.hr.git
cd poduzetnici.hr
```

2. Install dependencies:
```bash
npm install
```

3. Start the server:
```bash
npm start
```

4. Open your browser and navigate to:
```
http://localhost:3000
```

## API Endpoints

### Entrepreneurs

- `GET /api/entrepreneurs` - Get all entrepreneurs
- `POST /api/entrepreneurs` - Add a new entrepreneur
- `GET /api/entrepreneurs/search?query=<term>` - Search entrepreneurs

### Services

- `GET /api/services` - Get all services
- `POST /api/services` - Add a new service

### Resources

- `GET /api/resources` - Get all resources
- `POST /api/resources` - Add a new resource

## Usage

### Adding Your Entrepreneur Profile

1. Click on the "Poduzetnici" tab
2. Click "Dodaj svoj profil" button
3. Fill in your details (name, email, business, location, description)
4. Click "Spremi" to save

### Offering a Service

1. Click on the "Usluge" tab
2. Click "Ponudi uslugu" button
3. Fill in service details
4. Click "Spremi" to save

### Adding a Resource

1. Click on the "Resursi" tab
2. Click "Dodaj resurs" button
3. Fill in resource details
4. Click "Spremi" to save

## Technology Stack

- **Backend**: Node.js, Express.js
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Data Storage**: In-memory (for demo purposes)

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

MIT
