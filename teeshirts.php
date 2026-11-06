<?php
//librairie du catalogue de produits
include('lib/catalogue.lib.php');
// Définir la variable $page pour indiquer la page affichée.
$page = 'teeshirts';

/** @var stdClass $_  raccourci pour la section texte de cette page. */
/** @var string $langue Code de langue en 2 lettres*/

// Inclure la partie de haut de la page.
include('parties-communes/entete.php');



/***********gestion du tri ********** */
$tri = isset($_GET['tri']) ? $_GET['tri'] : "aleatoire";

[$themes, $produits] = obtenirCatalogue($page, $langue, $tri);


//trier les produits aléatoirement
shuffle($produits);

// Formatteur des montants d'argent
$formatteurMontants = new NumberFormatter($langue, NumberFormatter::CURRENCY);

?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage ?></h1>
		<form class="controle">
			<div class="filtre">
				<label for="filtre">Filtrer par thème : </label>
				<select name="filtre" id="filtre">

					<!---Gabarit pour le choix d'un thème--->
					<?php foreach ($themes as $codeTheme => $nomTheme) : ?>
						<option value="<?= $codeTheme; ?>"> <?= $nomTheme; ?> </option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="tri">
				<label for="tri">Trier par : </label>
				<select name="tri" id="tri">
					<option <?= ($tri=='aleatoire') ? 'selected' : '';?> value="aleatoire">Aléatoire</option>
					<option <?= ($tri=='venteDesc') ? 'selected' : '';?> value="venteDesc">Meilleur vendeur</option>
					<option <?= ($tri=='prixasc') ? 'selected' : '';?> value="prixasc">Prix / ascendant</option>
					<option <?= ($tri=='prixdesc') ? 'selected' : '';?> value="prixdesc">Prix / descendant</option>	
					<option <?= ($tri=='nomasc') ? 'selected' : '';?> value="nomasc">Nom / ascendant</option>
					<option <?= ($tri=='nomdesc') ? 'selected' : '';?> value="nomdesc">Nom / descendant</option>
					<option <?= ($tri=='dacDesc') ? 'selected' : '';?> value="dacDesc">Nouveauté</option>
				</select>
			</div>
		</form>
	</article>
	<article class="principal">
		<!-- Gabarit -->
		<?php foreach ($produits as $prd) : ?>
			<div class="produit">
				<span class="image">
					<img src="images/produits/teeshirts/<?= $prd->id; ?>.webp" alt="<?= $prd->nom->fr; ?>">
				</span>
				<span class="nom"><?= $prd->nom->fr; ?></span>
				<span class="prix"><?= $formatteurMontants->formatCurrency($prd->prix, 'CAD'); ?></span>
			</div>
		<?php endforeach; ?>
	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>