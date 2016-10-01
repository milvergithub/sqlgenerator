export class ApplicationService{
    
    constructor(API, $log, ToastService){
        'ngInject';
        this.API=API;
        this.$log=$log;
        this.ToastService=ToastService;
    }
    
    createApplication(project){
        this.API.all('application/create').post(project).then(function (data) {
            console.log(data);
        });
    }
}

