from flask import Flask, jsonify, request
from flask_cors import CORS
from pathlib import Path
import json

app = Flask(__name__)
CORS(app)

DATA = Path(__file__).resolve().parent.parent / "data" / "produits.json"

def read_products():
    return json.loads(DATA.read_text(encoding="utf-8"))

@app.get("/")
def home():
    return jsonify({"name":"BoutiquePro API","status":"ok"})

@app.get("/api/products")
def products():
    return jsonify(read_products())

@app.get("/api/products/<int:product_id>")
def product(product_id):
    item = next((p for p in read_products() if p["id"] == product_id), None)
    if not item:
        return jsonify({"error":"Produit introuvable"}), 404
    return jsonify(item)

@app.post("/api/orders")
def orders():
    data = request.get_json(silent=True) or {}
    required = ["name","email","phone","address"]
    missing = [x for x in required if not data.get(x)]
    if missing:
        return jsonify({"error":"Champs manquants","fields":missing}), 400
    return jsonify({"message":"Commande reçue en démonstration","order":data}), 201

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
