export class ConnectionService{
    constructor($auth,API, $log, ToastService){
        'ngInject';
        this.$auth=$auth;
        this.$log=$log;
        this.API=API;
        this.ToastService=ToastService;
    }

    submit(){

    }

    connectionDBTest(project){
        this.API.all('connectiontest').post(project).then(function (data) {
            console.log(data);
        });
    }
    connectionProject(project){
        this.$log.info(this.$auth.getToken());
        this.API.one('applications').get().then(function (data) {
            
        });
    }
}

