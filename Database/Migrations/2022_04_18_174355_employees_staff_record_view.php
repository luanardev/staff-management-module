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
                CREATE VIEW app_employees_staff_record_view AS
                SELECT
                app_employees_staff_members.id,
                app_employees_staff_members.employee_number,
                app_employees_staff_members.title,
                app_employees_staff_members.firstname,
                app_employees_staff_members.lastname,
                CONCAT(app_employees_staff_members.firstname,' ',app_employees_staff_members.lastname) AS fullname,
                app_employees_staff_members.gender,
                TIMESTAMPDIFF(YEAR, app_employees_staff_members.date_of_birth, CURDATE()) AS age,
                app_employees_staff_members.official_email as email,
                app_employees_staff_members.avatar,
                app_employees_positions.name AS `position`,
                app_employees_job_rank.name AS `rank`,
                app_employees_staff_employment.grade,
                app_employees_staff_employment.notch,
                app_employees_job_type.name AS type,
                app_employees_job_category.name AS category,
                app_employees_job_status.name AS `status`,
                app_employees_progress_type.name AS progress_type,
                app_employees_progress_type.description AS progress_description,
                app_organization_branches.name AS branch,
                app_organization_campuses.name AS campus,
                app_organization_departments.name AS department,
                app_organization_sections.name AS section,
                app_employees_staff_employment.confirmation_status,
                app_employees_staff_employment.confirmation_date,
                app_employees_staff_employment.confirmation_comment,
                app_employees_staff_employment.start_date,
                app_employees_staff_employment.end_date,
                TIMESTAMPDIFF(YEAR, app_employees_staff_employment.start_date, CURDATE()) AS period_after_appointment,
                TIMESTAMPDIFF(YEAR, app_employees_staff_employment.confirmation_date, CURDATE()) AS period_after_confirmation,
                app_employees_staff_employment.position_id,
                app_employees_staff_employment.job_rank_id,
                app_employees_staff_employment.job_type_id,
                app_employees_staff_employment.job_status_id,
                app_employees_staff_employment.job_category_id,
                app_employees_staff_employment.progress_type_id,
                app_employees_staff_employment.branch_id,
                app_employees_staff_employment.department_id,
                app_employees_staff_employment.section_id
                FROM app_employees_staff_members
                JOIN app_employees_staff_employment ON app_employees_staff_members.id = app_employees_staff_employment.staff_id
                JOIN app_employees_positions ON app_employees_positions.id = app_employees_staff_employment.position_id
                JOIN app_employees_job_rank ON app_employees_job_rank.id = app_employees_staff_employment.job_rank_id
                JOIN app_employees_job_type ON app_employees_job_type.id = app_employees_staff_employment.job_type_id
                JOIN app_employees_job_status ON app_employees_job_status.id = app_employees_staff_employment.job_status_id
                JOIN app_employees_job_category ON app_employees_job_category.id = app_employees_staff_employment.job_category_id
                JOIN app_employees_progress_type ON app_employees_progress_type.id = app_employees_staff_employment.progress_type_id
                JOIN app_organization_branches ON app_organization_branches.id = app_employees_staff_employment.branch_id
                JOIN app_organization_campuses ON app_organization_campuses.id = app_employees_staff_employment.campus_id
                JOIN app_organization_departments ON app_organization_departments.id = app_employees_staff_employment.department_id
                JOIN app_organization_sections ON app_organization_sections.id = app_employees_staff_employment.section_id
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
            DROP VIEW IF EXISTS `app_employees_staff_record_view`;
           ";
    }
};
