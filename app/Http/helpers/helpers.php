<?php

function setActive($routeName)
{
    return request()->routeIs($routeName) ? 'active':'';
}

function getTeacherFromSubject($subject)
{
    $teacherCheck = $subject->teacherInSections->first();

    return $teacherCheck != null ? $teacherCheck->teacher : null;
}


?>