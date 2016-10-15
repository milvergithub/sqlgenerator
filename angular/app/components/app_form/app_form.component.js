class AppFormController{
    constructor($log,ConnectionService,ApplicationService){
        'ngInject';
        this.$log=$log;
        this.ConnectionService=ConnectionService;
        this.ApplicationService=ApplicationService;
        this.project={
            name:"",
            driver:"",
            schema:"public",
            database:"",
            host:"",
            port:"",
            username:"",
            password:"",
            date_created:new Date()
        }
    }

    $onInit(){
    }

    connectionTest(){
        this.ConnectionService.connectionDBTest(this.project);
    }
    
    connectionApp(){
        this.ConnectionService.connectionProject(this.project);
    }
    
    createApp(){
        this.ApplicationService.createApplication(this.project)
    }
}

export const AppFormComponent = {
    templateUrl: './views/app/components/app_form/app_form.component.html',
    controller: AppFormController,
    controllerAs: 'vm',
    bindings: {}
};
