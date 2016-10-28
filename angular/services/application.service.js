export class ApplicationService{
    
    constructor($auth,API, $log, ToastService){
        'ngInject';
        this.$auth=$auth;
        this.API=API;
        this.$log=$log;
        this.ToastService=ToastService;
    }
    
    createApplication(project){
        this.API.all('applications').post(project).then(function (data) {
            console.log(data);
        });
    }
}

