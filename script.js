// Récupère les éléments HTML nécessaires
const container = document.getElementById('championContainer'); // Conteneur pour afficher les champions
const searchInput = document.getElementById('searchInput'); // Champ de recherche
let allChampions = []; // Tableau pour stocker tous les champions

// Étape 1 : récupérer la version la plus récente du patch à partir de l'API de League of Legends
fetch("https://ddragon.leagueoflegends.com/api/versions.json")
    .then(res => res.json()) // Transforme la réponse en JSON
    .then(versions => {
        const latestVersion = versions[0]; // La première version dans la liste est la plus récente

        // Étape 2 : récupérer la liste des champions à partir de la version la plus récente
        return fetch(`https://ddragon.leagueoflegends.com/cdn/${latestVersion}/data/fr_FR/champion.json`);
    })
    .then(res => res.json()) // Transforme la réponse en JSON
    .then(data => {
        // Sauvegarde tous les champions dans la variable 'allChampions'
        allChampions = Object.values(data.data);

        // Étape 3 : afficher les champions sur la page
        displayChampions(allChampions);
    })
    .catch(error => {
        // En cas d'erreur, afficher un message d'erreur dans la console
        console.error("Erreur lors du chargement des données :", error);
    });

// Fonction pour afficher les champions dans le conteneur
function displayChampions(champions) {
    container.innerHTML = ''; // Réinitialise le contenu du conteneur avant d'afficher de nouveaux champions
    champions.forEach(champ => {
        const champName = champ.id; // Le nom du champion utilisé pour l'URL de l'image de splash
        const splashUrl = `https://ddragon.leagueoflegends.com/cdn/img/champion/splash/${champName}_0.jpg`; // URL de l'image de splash
        const champTitle = champ.title; // Le titre du champion, par exemple "la reine de la glace"

        // Crée un nouvel élément div pour chaque champion
        const champDiv = document.createElement('div');
        champDiv.className = "champion"; // Ajoute une classe CSS pour le style

        // Applique des styles directement sur chaque carte de champion via JavaScript
        champDiv.style.border = "2px solid #fbbf24"; // Bordure jaune
        champDiv.style.borderRadius = "10px"; // Bordure légèrement arrondie
        champDiv.style.overflow = "hidden"; // Empêche les images de déborder
        champDiv.style.transition = "transform 0.3s ease"; // Effet de transformation sur le survol
        champDiv.style.width = "300px"; // Largeur des cartes

        // Remplir l'HTML de l'élément div avec les informations du champion
        champDiv.innerHTML = `
            <a href="champion.php?champion=${champName}">
                <img src="${splashUrl}" alt="Cliquez pour rediriger" style="width: 100%; display: block;">
            </a>
            <div style="padding: 10px; background: #222; text-align: center; color: #fbbf24;">
                ${champ.name} - ${champTitle}
            </div>
        `;

        // Appliquer l'effet de survol pour agrandir légèrement la carte
        champDiv.addEventListener("mouseenter", () => {
            champDiv.style.transform = "scale(1.05)";
        });

        champDiv.addEventListener("mouseleave", () => {
            champDiv.style.transform = "scale(1)";
        });

        // Ajoute le div du champion dans le conteneur
        container.appendChild(champDiv);
    });
}

// Fonction pour filtrer les champions en fonction de la recherche
function filterChampions() {
    const query = searchInput.value.toLowerCase(); // Récupère la valeur de recherche et la met en minuscule
    // Filtrer les champions dont le nom contient la chaîne de recherche
    const filteredChampions = allChampions.filter(champ => 
        champ.name.toLowerCase().includes(query) // Vérifie si le nom du champion contient la recherche
    );
    // Affiche les champions filtrés
    displayChampions(filteredChampions);
}
