// Bloc d'attente pour le chargement complet du DOM
document.addEventListener('DOMContentLoaded', function() {
    
    // Récupère le conteneur des skins où les éléments seront ajoutés
    const skinsContainer = document.getElementById('skinsContainer');

    // Récupère le nom du champion depuis la variable PHP (championName)
    const championName = window.championName;

    // Ajout du style pour organiser plusieurs cartes par ligne
    skinsContainer.style.display = "flex";
    skinsContainer.style.flexWrap = "wrap";
    skinsContainer.style.justifyContent = "center";
    skinsContainer.style.gap = "20px";
    skinsContainer.style.padding = "20px";

    // Vérifie si un nom de champion est passé depuis le PHP
    if (championName) {
        // Étape 1 : Récupérer les données du champion via l'API Riot
        const url = `https://ddragon.leagueoflegends.com/cdn/15.7.1/data/fr_FR/champion/${championName}.json`;

        fetch(url) // Effectue une requête fetch pour obtenir les informations
            .then(response => response.json()) // Parse la réponse JSON
            .then(data => {
                // Accède aux données spécifiques du champion
                const champion = data.data[championName];

                // Si des skins sont disponibles pour ce champion, on les affiche
                if (champion && champion.skins) {
                    displaySkins(champion.skins); // Appel à la fonction d'affichage des skins
                } else {
                    skinsContainer.innerHTML = '<p>Aucun skin disponible pour ce champion.</p>'; // Si aucun skin, message d'erreur
                }
            })
            .catch(error => {
                console.error('Erreur de récupération des données :', error);
                skinsContainer.innerHTML = '<p>Une erreur est survenue lors de la récupération des skins.</p>'; // Affichage en cas d'erreur
            });
    } else {
        skinsContainer.innerHTML = '<p>Le nom du champion est manquant.</p>'; // Si championName n'existe pas
    }

    // Fonction pour afficher les skins du champion
    function displaySkins(skins) {
        skinsContainer.innerHTML = ''; // Réinitialise le contenu du conteneur avant d'afficher de nouveaux skins
        skins.forEach(skin => {
            const skinNum = skin.num; // Numéro du skin utilisé dans l'URL
            const skinName = skin.name === "default" ? championName : skin.name; // Nom du skin ou nom du champion par défaut
            const splashUrl = `https://ddragon.leagueoflegends.com/cdn/img/champion/splash/${championName}_${skinNum}.jpg`; // URL de l'image du skin

            // Crée un nouvel élément div pour chaque skin
            const skinDiv = document.createElement('div');
            skinDiv.className = "skin"; // Ajoute une classe CSS pour le style

            // Applique des styles directement sur chaque carte de skin via JavaScript
            skinDiv.style.border = "2px solid #fbbf24"; // Bordure jaune
            skinDiv.style.borderRadius = "10px"; // Bordure légèrement arrondie
            skinDiv.style.overflow = "hidden"; // Empêche les images de déborder
            skinDiv.style.transition = "transform 0.3s ease"; // Effet de transformation sur le survol
            skinDiv.style.width = "300px"; // Largeur des cartes
            skinDiv.style.backgroundColor = "#111"; // Fond noir pour le texte

            // Remplir l'HTML de l'élément div avec les informations du skin
            skinDiv.innerHTML = `
                <img src="${splashUrl}" alt="${skinName}" style="width: 100%; display: block;">
                <div class="skin-name" style="padding: 10px; background: #222; text-align: center; color: #fbbf24;">
                    ${skinName}
                </div>
            `;

            // Appliquer l'effet de survol pour agrandir légèrement la carte
            skinDiv.addEventListener("mouseenter", () => {
                skinDiv.style.transform = "scale(1.05)";
            });

            skinDiv.addEventListener("mouseleave", () => {
                skinDiv.style.transform = "scale(1)";
            });

            // Ajoute le div du skin dans le conteneur
            skinsContainer.appendChild(skinDiv);
        });
    }
});
