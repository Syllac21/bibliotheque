

<?php if(!isset($_SESSION['LOGGED_USER'])): ?>
    <form action="submit_login.php" method="POST">
        <!-- message d'erreur -->
        <?php if(isset($_SESSION['LOGIN_ERROR_MESSAGE'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
            </div>
        <?php endif; ?>
        <!-- label et input --> 
        <div class="mb-3">
            <label for="email" class="form-label"> Email </label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="email-help" placeholder="nom@exemple.fr">
            <div id="email-help" class="form-text">Email utilisé comme identifiant lors de la création du compte</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <!-- message de succès d'identification --> 
    <?php else : ?>
        <div class="alert alert-success" role="alert">
            Bienvenue <?php echo $_SESSION['LOGGED_USER']['email']; ?>
        </div>
    <?php endif; ?>