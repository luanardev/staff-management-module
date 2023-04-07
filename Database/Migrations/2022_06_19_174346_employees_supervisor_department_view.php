<?php

use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createView());
    }

    /**
     * Create table view
     *
     * @return string
     */
    private function createView()
    {
        return "
                CREATE VIEW app_employees_supervisor_department_view AS
                SELECT
                app_employees_staff_members.id AS id,
                app_employees_staff_members.employee_number AS employee_number,
                app_employees_staff_members.title AS title,
                app_employees_staff_members.firstname AS firstname,
				app_employees_staff_members.lastname AS lastname,
				concat(app_employees_staff_members.firstname,' ',app_employees_staff_members.lastname) AS fullname,
                app_organization_campuses.name AS campus,
                app_organization_departments.name AS department,
                app_employees_supervisor_department.position,
                app_employees_supervisor_department.start_date,
                app_employees_supervisor_department.end_date,
                app_employees_supervisor_department.department_id,
                app_employees_supervisor_department.campus_id
                FROM app_employees_supervisor_department
                JOIN app_employees_staff_members ON app_employees_staff_members.id = app_employees_supervisor_department.staff_id
                JOIN app_organization_departments ON app_organization_departments.id = app_employees_supervisor_department.department_id
                JOIN app_organization_campuses ON app_organization_campuses.id = app_employees_supervisor_department.campus_id
            ";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }

    /**
     * Drop table view
     *
     * @return strinf
     */
    private function dropView()
    {
        return "
            DROP VIEW IF EXISTS `app_employees_supervisor_department_view`;
            ";
    }
};
