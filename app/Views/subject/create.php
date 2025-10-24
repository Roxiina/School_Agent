<h1>Ajouter une matière</h1>

<form action="/subject/create" method="POST">
    <input type="text" name="nom" placeholder="Nom de la matière" required><br>
    <input type="number" name="id_agent" placeholder="Agent" required><br>
    <button type="submit">Enregistrer</button>
</form>