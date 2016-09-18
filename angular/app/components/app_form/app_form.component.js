class AppFormController{
    constructor($log,ConnectionService){
        'ngInject';
        this.$log=$log;
        this.ConnectionService=ConnectionService;
        this.project={
            name:"",
            driver:"",
            database:"",
            host:"",
            port:"",
            username:"",
            password:""
        }
    }

    $onInit(){
    }

    connectionTest(){
        this.ConnectionService.connectionDBTest(this.project);
    }
}

export const AppFormComponent = {
    templateUrl: './views/app/components/app_form/app_form.component.html',
    controller: AppFormController,
    controllerAs: 'vm',
    bindings: {}
};
