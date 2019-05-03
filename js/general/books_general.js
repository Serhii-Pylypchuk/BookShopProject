//Создаем объекты классов
//Реализовать связь между объектами можно и через прототип, на так интересней и понятней
var requestObject = new AjaxRequest;
var validationObject = new Validation;
var myModel = new Model(requestObject,validationObject);
var myView = new View(myModel);
var myController = new Controller(myModel,myView);

//Запускаем обработчики событий
myController.start_books_controller();
