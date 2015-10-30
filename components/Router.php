<?php

/**
* *
*/
class Router
{

	//маршрути
	private $routes;


	public function __construct()
	{
		//шлях до файлу з роутами
		$routesPath = ROOT . '/config/routes.php';

		//тут присвоююється властивості $routes масив, який знаходиться в файлі з роутами
		$this->routes = include($routesPath);
	}


	//повертає строку запросу (що введено в рядку адреси в браузері)
	private function getUri() 
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}


	public function run ()
	{
		
		$uri = $this->getUri();
		
		foreach ($this->routes as $uriPattern => $path) {
			
			//якщо в запросі ($uri) є строка, яка відповідає ключу в масиві роута, то
			if (preg_match("~$uriPattern~", $uri)) {
				

				//ця фукнція шукає параметри запиту по шаблону в роуті і якщо вони є, то вони підставляються в цей шаблон
				//результатом є внутрішній шлях
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);



				//то значення(строку) цього ключа розділямо по символу '/' і формуємо масив
				//це для того, щоб потім використати кожне слово цієї строки окремо
				$segments = explode('/', $internalRoute);


				//тут визначається який клас і який метод підключається відповідно до запиту в строці адреси браузера
				$controllerName = ucfirst(array_shift ($segments) . 'Controller');
				$actionName = 'action' . ucfirst(array_shift($segments));

				
				//те, що залишилось від запиту після того, як з нього забрали значення для назви контроллера і методу
				//і те, що залишилось - це параметри (щось на зразок GET), які будуть використовуватись далі
				$parameters = $segments;

				$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
				
				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}
				else {
					include_once(ROOT . '/controllers/request_errorController.php');
				}

				$controllerObject = new $controllerName;

				//ця функція викликає метод $actionName з об'єкту $controllerObject і передає йому масив з параметрами
				//(і вони будуть передані як змінні)
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);

				if ($result != NULL) {
					break;
				}
			
			//коли знаходить  необхідний шаблон в роутах, то припиняє шукати інші (видали break і побачиш що буде)
			break;

			}
		}
	}
}