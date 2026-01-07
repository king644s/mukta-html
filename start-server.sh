#!/bin/bash

# Start PHP Built-in Development Server
# This script starts the PHP server on port 8000

echo "🚀 Starting Mukta Exports PHP Server..."
echo ""
echo "📍 Server will be available at:"
echo "   http://localhost:8000"
echo ""
echo "📝 To stop the server, press Ctrl+C"
echo ""

# Start PHP server with router.php
php -S localhost:8000 router.php

