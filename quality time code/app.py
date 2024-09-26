from flask import Flask, request, jsonify
from flask_cors import CORS
import google.generativeai as genai

# Inicialize o Flask
app = Flask(__name__)

# Configure o CORS para permitir solicitações do frontend
CORS(app)

# Configure a chave de API
genai.configure(api_key="AIzaSyCOtqHATOgx8E1RX8yZn2rfdFZrbXYf8DI")  # Substitua pela sua chave API correta

# Inicialize o modelo
try:
    model = genai.GenerativeModel('gemini-pro')
    chat = model.start_chat(history=[])
    print("Modelo inicializado com sucesso.")
except Exception as e:
    print(f"Erro ao inicializar o modelo: {e}")
    chat = None

# Rota de teste (GET) para verificar se o servidor está funcionando
@app.route('/', methods=['GET'])
def home():
    return "Servidor Flask está rodando."

# Rota do chatbot (POST)
@app.route('/chat', methods=['POST'])
def chat_with_bot():
    if chat is None:
        return jsonify({'response': 'Erro na inicialização do modelo.'}), 500
    
    try:
        user_message = request.json.get('message')
        if not user_message:
            return jsonify({'response': 'Nenhuma mensagem foi fornecida.'}), 400
        
        # Envie a mensagem ao modelo
        response = chat.send_message(user_message)
        return jsonify({'response': response.text})
    
    except Exception as e:
        print(f"Erro no servidor: {e}")
        return jsonify({'response': 'Desculpe, algo deu errado.'}), 500

if __name__ == '__main__':
    app.run(port=5500)
