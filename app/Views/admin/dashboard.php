<?php require_once __DIR__ . '/../templates/admin_header.php'; ?>

<h1>Bienvenue dans le Dashboard Admin</h1>
<p>Zone protégée réservée aux administrateurs.</p>

<p><a href="/admin/user">👥 Gérer les utilisateurs</a></p>
<p><a href="/admin/level">📚 Gérer les niveaux scolaires</a></p>
<p><a href="/admin/message">💬 Gérer les messages</a></p>
<p><a href="/admin/conversation">💬 Gérer les conversations</a></p>
<p><a href="/admin/subject">📚 Gérer les matières</a></p>
<p><a href="/admin/agent">🤖 Gérer les agents</a></p>
<p><a href="/admin/userlog">📜 Gérer les connexions (User Log)</a></p>
<p><a href="/admin/useragent">🔗 userAgent => utiliser</a></p>

<?php require_once __DIR__ . '/../templates/admin_footer.php'; ?>
