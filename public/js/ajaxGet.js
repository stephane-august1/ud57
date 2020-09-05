
/**
 * Cette fonction effectue un appel Ajax vers une url et retourne une promesse
 * @param {string} url 
 */
 function ajaxGet(url){
    return new Promise(function(resolve, reject){
        // Nous allons gérer la promesse
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function(){
            // Si le traitement est terminé
            if(xmlhttp.readyState == 4){
                // Si le traitement est un succès
                if(xmlhttp.status == 200){
                    // On résoud la promesse et on renvoie la réponse
                    resolve(xmlhttp.responseText);
                   
                }else{
                    // On résoud la promesse et on envoie l'erreur
                    reject(xmlhttp);
                }
            }
        }

        // Si une erreur est survenue
        xmlhttp.onerror = function(error){
            // On résoud la promesse et on envoie l'erreur
            reject(error);
        }

        // On ouvre la requête
        xmlhttp.open('GET', url, true);

        // On envoie la requête
        xmlhttp.send(null);
    })
 
}

