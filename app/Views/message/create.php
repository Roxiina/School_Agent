<h1>Ajouter un message</h1>

<form action="/message/create" method="POST">
    <input type="text" name="question" placeholder="Question" required><br>
    <input type="text" name="reponse" placeholder="Réponse" required><br>
    <input type="number" name="id_conversation" placeholder="Conversation" required><br>
    <button type="submit">Enregistrer</button>
</form>
