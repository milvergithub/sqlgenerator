<?php
/**
 * @author milver.
 * User: milver
 * Date: 28-10-16
 * Time: 12:06 AM
 */

namespace app\Models;


class Metadata{

    public function getTables($scheme="public"){
        $query = "SELECT tablename FROM pg_tables WHERE schemaname = '".$scheme."'";
    }

    public function getTableDetail($table_name,$sheme="public"){
        $query="SELECT  tab_columns.column_name, data_type, character_maximum_length,
	                    numeric_precision, is_nullable, tab_constraints.constraint_type
                FROM 	information_schema.columns AS tab_columns
	            LEFT OUTER JOIN
	                    information_schema.constraint_column_usage AS col_constraints
	                 ON tab_columns.table_name = col_constraints.table_name AND
                        tab_columns.column_name = col_constraints.column_name
                LEFT OUTER JOIN
                        information_schema.table_constraints AS tab_constraints
                     ON tab_constraints.constraint_name = col_constraints.constraint_name
                LEFT OUTER JOIN
                        information_schema.check_constraints AS col_check_constraints
                     ON col_check_constraints.constraint_name = tab_constraints.constraint_name
                WHERE   tab_columns.table_name = '" . $table_name . "' AND
                        tab_columns.table_schema = '".$sheme."' AND
                        (tab_constraints.constraint_type='PRIMARY KEY' OR tab_constraints.constraint_type ISNULL)
                ORDER BY ordinal_position;";

    }

    public function getReferences($table){
        $query = "SELECT (SELECT relname
                         FROM pg_catalog.pg_class c LEFT JOIN
                              pg_catalog.pg_namespace n ON n.oid = c.relnamespace
                         WHERE
                              c.oid=r.conrelid) as nombre,conname,
                              pg_catalog.pg_get_constraintdef(oid, true) as referencias from
                              pg_catalog.pg_constraint r WHERE r.conrelid in
                              ( SELECT c.oid FROM pg_catalog.pg_class c LEFT JOIN
                              pg_catalog.pg_namespace n ON n.oid = c.relnamespace WHERE c.relname !~
                              'pg_' and c.relkind = 'r' AND pg_catalog.pg_table_is_visible(c.oid))
                              AND r.contype = 'f'
                              AND (SELECT relname FROM pg_catalog.pg_class c LEFT JOIN
                              pg_catalog.pg_namespace n ON n.oid = c.relnamespace WHERE
                              c.oid=r.conrelid)='" . $table . "';";
    }
    public function getTablesCatalatorEntityType($scheme){
        $query = "SELECT tablename
                 FROM pg_tables
                 WHERE schemaname = '".$scheme."' AND
                       tablename NOT IN(SELECT (SELECT relname FROM pg_catalog.pg_class c LEFT JOIN
                       pg_catalog.pg_namespace n ON n.oid = c.relnamespace WHERE
                       c.oid=r.conrelid) as nombre
                 FROM
                       pg_catalog.pg_constraint r WHERE r.conrelid in
                       ( SELECT c.oid FROM pg_catalog.pg_class c LEFT JOIN
                                pg_catalog.pg_namespace n ON n.oid = c.relnamespace WHERE c.relname !~
                                'pg_' and c.relkind = 'r' AND pg_catalog.pg_table_is_visible(c.oid))
                                AND r.contype = 'f')";
    }
    public function getTableDetailColumn($table){
        $query="SELECT column_name,column_default,is_nullable,column_default AS llave,data_type 
                FROM information_schema.columns 
                WHERE table_name = '".$table."';";
    }
}