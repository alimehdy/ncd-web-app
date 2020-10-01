<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');
header("content-type: application/json");

$clinic_id = $_SESSION['clinic_id'];
$selectedDate = $_POST['selectedDate'];
$visit_status = "Active";
//Result of the selected month
$monthArr = array();
//Result of all time
$alltimeArr = array();

//Total NCD Patient
$ncdPatient = "SELECT 
    count(*)
from 
	visit 
where 
	visit_status=:visit_status 
    AND 
     
		month(visit.date_of_visit)=month(:selectedDate)
        AND
        year(visit.date_of_visit)=year(:selectedDate)
        AND clinic_id = :cid
    GROUP BY visit.patient_id
";
$ncdPatientExec = $conn->prepare($ncdPatient);
$ncdPatientExec->bindValue(":visit_status", $visit_status);
$ncdPatientExec->bindValue(":selectedDate", $selectedDate);
$ncdPatientExec->bindValue(":cid", $clinic_id);
$ncdPatientExec->execute();
//$ncdPatientExecRes = $ncdPatientExec->fetchAll();
$CountRow = $ncdPatientExec->rowCount();

//Total NCD Consultation
$ncdConsultation = "SELECT 
    count(*)
from 
	visit 
where 
	visit_status=:visit_status 
    AND 
     
		month(visit.date_of_visit)=month(:selectedDate)
        AND
        year(visit.date_of_visit)=year(:selectedDate)
        AND clinic_id = :cid
";
$ncdConsultationExec = $conn->prepare($ncdConsultation);
$ncdConsultationExec->bindValue(":visit_status", $visit_status);
$ncdConsultationExec->bindValue(":selectedDate", $selectedDate);
$ncdConsultationExec->bindValue(":cid", $clinic_id);
$ncdConsultationExec->execute();
$ncdConsultationExecRes = $ncdConsultationExec->fetchColumn();

//New patients
$ncdNewPatient = "SELECT 
    count(*)
from 
	patient 
where 
	patient_status=:visit_status 
    AND 
     
		month(patient.registration_date)=month(:selectedDate)
        AND
        year(patient.registration_date)=year(:selectedDate)
    AND
    	clinic_id = :cid
";
$ncdNewPatientExec = $conn->prepare($ncdNewPatient);
$ncdNewPatientExec->bindValue(":visit_status", $visit_status);
$ncdNewPatientExec->bindValue(":selectedDate", $selectedDate);
$ncdNewPatientExec->bindValue(":cid", $clinic_id);
$ncdNewPatientExec->execute();
$ncdNewPatientExecRes = $ncdNewPatientExec->fetchColumn();

//Medication Collection
$ncdMedCollection = "SELECT count(*) 
FROM 
	visit
where 
	month(date_of_visit)=month(:selectedDate)
and 
	year(date_of_visit)=year(:selectedDate)
and 
	consultation_type=:consultation_type
and 
	visit_status=:visit_status
and clinic_id = :cid
";
$ncdMedCollectionExec = $conn->prepare($ncdMedCollection);
$ncdMedCollectionExec->bindValue(":visit_status", $visit_status);
$ncdMedCollectionExec->bindValue(":selectedDate", $selectedDate);
$ncdMedCollectionExec->bindValue(":consultation_type", "MedicationCollection");
$ncdMedCollectionExec->bindValue(":cid", $clinic_id);
$ncdMedCollectionExec->execute();
$ncdMedCollectionExecRes = $ncdMedCollectionExec->fetchColumn();

//NCD-Cardio
$ncdCardio = "SELECT count(*) 
FROM 
	visit
where 
	month(date_of_visit)=month(:selectedDate)
and 
	year(date_of_visit)=year(:selectedDate)
and 
	consultation_type=:consultation_type
and 
	visit_status=:visit_status
and
	clinic_id = :cid
";
$ncdCardioExec = $conn->prepare($ncdCardio);
$ncdCardioExec->bindValue(":visit_status", $visit_status);
$ncdCardioExec->bindValue(":selectedDate", $selectedDate);
$ncdCardioExec->bindValue(":consultation_type", "NCD – Cardiologist");
$ncdCardioExec->bindValue(":cid", $clinic_id);
$ncdCardioExec->execute();
$ncdCardioExecRes = $ncdCardioExec->fetchColumn();

//NCD-Endo
$ncdEndo = "SELECT count(*) 
FROM 
	visit
where 
	month(date_of_visit)=month(:selectedDate)
and 
	year(date_of_visit)=year(:selectedDate)
and 
	consultation_type=:consultation_type
and 
	visit_status=:visit_status
and clinic_id=:cid
";
$ncdEndoExec = $conn->prepare($ncdEndo);
$ncdEndoExec->bindValue(":visit_status", $visit_status);
$ncdEndoExec->bindValue(":selectedDate", $selectedDate);
$ncdEndoExec->bindValue(":consultation_type", "NCD – Endocrinologist");
$ncdEndoExec->bindValue(":cid", $clinic_id);
$ncdEndoExec->execute();
$ncdEndoExecRes = $ncdEndoExec->fetchColumn();

//Medication Collection (Himself)
$ncdMedCollectionHimself = "SELECT 
	* 
from 
	visit
left join 
	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE
	consultation_med.medication_collector=:med_collection
    AND
    month(visit.date_of_visit)=month(:selectedDate)
    AND
    year(visit.date_of_visit)=year(:selectedDate)
    AND visit.visit_status=:visit_status
    AND visit.clinic_id = :cid
group by visit.visit_id

";
$ncdMedCollectionHimselfExec = $conn->prepare($ncdMedCollectionHimself);
$ncdMedCollectionHimselfExec->bindValue(":visit_status", $visit_status);
$ncdMedCollectionHimselfExec->bindValue(":selectedDate", $selectedDate);
$ncdMedCollectionHimselfExec->bindValue(":med_collection", "Himself");
$ncdMedCollectionHimselfExec->bindValue(":cid", $clinic_id);
$ncdMedCollectionHimselfExec->execute();
//$ncdEndoExecRes = $ncdEndoExec->fetchColumn();
$medCollectionHimself = $ncdMedCollectionHimselfExec->rowCount();

//Medication Collection (Relative)
$ncdMedCollectionRelative = "SELECT 
	* 
from 
	visit
left join 
	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE
	consultation_med.medication_collector=:med_collection
    AND
    month(visit.date_of_visit)=month(:selectedDate)
    AND
    year(visit.date_of_visit)=year(:selectedDate)
    AND visit.visit_status=:visit_status
    AND visit.clinic_id = :cid
group by visit.visit_id

";
$ncdMedCollectionRelativeExec = $conn->prepare($ncdMedCollectionRelative);
$ncdMedCollectionRelativeExec->bindValue(":visit_status", $visit_status);
$ncdMedCollectionRelativeExec->bindValue(":selectedDate", $selectedDate);
$ncdMedCollectionRelativeExec->bindValue(":med_collection", "Relative");
$ncdMedCollectionRelativeExec->bindValue(":cid", $clinic_id);
$ncdMedCollectionRelativeExec->execute();
$medCollectionRelative = $ncdMedCollectionRelativeExec->rowCount();

//Medication Collection (Other)
$ncdMedCollectionOther = "SELECT 
	* 
from 
	visit
left join 
	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE
	consultation_med.medication_collector=:med_collection
    AND
    month(visit.date_of_visit)=month(:selectedDate)
    AND
    year(visit.date_of_visit)=year(:selectedDate)
    AND visit.visit_status=:visit_status
    AND
    visit.clinic_id=:cid
group by visit.visit_id

";
$ncdMedCollectionOtherExec = $conn->prepare($ncdMedCollectionOther);
$ncdMedCollectionOtherExec->bindValue(":visit_status", $visit_status);
$ncdMedCollectionOtherExec->bindValue(":selectedDate", $selectedDate);
$ncdMedCollectionOtherExec->bindValue(":med_collection", "Other");
$ncdMedCollectionOtherExec->bindValue(":cid", $clinic_id);
$ncdMedCollectionOtherExec->execute();
$medCollectionOther = $ncdMedCollectionOtherExec->rowCount();

//HGT
$ncdHGT = "SELECT 
	count(*) 
FROM 
	lab_test 
where 
	month(test_date)=month(:selectedDate)
	and 
	year(test_date)=year(:selectedDate)
	and 
	glycemia<>'' 
	and 
	lab_status = :visit_status
	and
	clinic_id = :cid
";
$ncdHGTExec = $conn->prepare($ncdHGT);
$ncdHGTExec->bindValue(":visit_status", $visit_status);
$ncdHGTExec->bindValue(":selectedDate", $selectedDate);
$ncdHGTExec->bindValue(":cid", $clinic_id);
$ncdHGTExec->execute();
$ncdHGTExecRes = $ncdHGTExec->fetchColumn();

//Assessment Numbers and average
$ncdAssessment = "SELECT
	count(assessment_result) as total_assessment, 
	avg(assessment_result) as averageAssessment
FROM 
	diabetes_assessment
where 
	month(date_of_assessment)=month(:selectedDate) 
AND 
	year(date_of_assessment)=year(:selectedDate)
AND
	clinic_id = :cid
";
$ncdAssessmentExec = $conn->prepare($ncdAssessment);
$ncdAssessmentExec->bindValue(":selectedDate", $selectedDate);
$ncdAssessmentExec->bindValue(":cid", $clinic_id);
$ncdAssessmentExec->execute();
$ncdAssessmentExecRes = $ncdAssessmentExec->fetch();

//Lebanese Nationality Patients
$ncdLebPatient = "SELECT 
	count(visit.visit_id) 
from patient left join visit on patient.patient_id=visit.patient_id Left join
	

	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE

    month(visit.date_of_visit)=month(:selectedDate)
    AND
    year(visit.date_of_visit)=year(:selectedDate)
    AND visit.visit_status=:visit_status
    AND patient.nationality=:nationality
    AND patient.clinic_id = :cid
group by visit.patient_id

";
$ncdLebPatientExec = $conn->prepare($ncdLebPatient);
$ncdLebPatientExec->bindValue(":visit_status", $visit_status);
$ncdLebPatientExec->bindValue(":selectedDate", $selectedDate);
$ncdLebPatientExec->bindValue(":nationality", "Lebanese");
$ncdLebPatientExec->bindValue(":cid", $clinic_id);
$ncdLebPatientExec->execute();
$ncdLebPatientExecRes = $ncdLebPatientExec->rowCount();

//Syrian Nationality Patients
$ncdSyrianPatient = "SELECT 
	count(visit.visit_id) 
from patient left join visit on patient.patient_id=visit.patient_id Left join
	

	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE

    month(visit.date_of_visit)=month(:selectedDate)
    AND
    year(visit.date_of_visit)=year(:selectedDate)
    AND visit.visit_status=:visit_status
    AND patient.nationality=:nationality
    AND patient.clinic_id = :cid
group by visit.patient_id

";
$ncdSyrianPatientExec = $conn->prepare($ncdSyrianPatient);
$ncdSyrianPatientExec->bindValue(":visit_status", $visit_status);
$ncdSyrianPatientExec->bindValue(":selectedDate", $selectedDate);
$ncdSyrianPatientExec->bindValue(":nationality", "Syrian");
$ncdSyrianPatientExec->bindValue(":cid", $clinic_id);
$ncdSyrianPatientExec->execute();
$ncdSyrianPatientExecRes = $ncdSyrianPatientExec->rowCount();

//Other Nationality Patients
$ncdOtherPatient = "SELECT 
	count(visit.visit_id) 
from patient left join visit on patient.patient_id=visit.patient_id Left join
	

	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE

    month(visit.date_of_visit)=month(:selectedDate)
    AND
    year(visit.date_of_visit)=year(:selectedDate)
    AND visit.visit_status=:visit_status
    AND patient.nationality<>:nationality1
    AND patient.nationality<>:nationality2
    AND patient.clinic_id = :cid
group by visit.patient_id

";
$ncdOtherPatientExec = $conn->prepare($ncdOtherPatient);
$ncdOtherPatientExec->bindValue(":visit_status", $visit_status);
$ncdOtherPatientExec->bindValue(":selectedDate", $selectedDate);
$ncdOtherPatientExec->bindValue(":nationality1", "Syrian");
$ncdOtherPatientExec->bindValue(":nationality2", "Lebanese");
$ncdOtherPatientExec->bindValue(":cid", $clinic_id);
$ncdOtherPatientExec->execute();
$ncdOtherPatientExecRes = $ncdOtherPatientExec->rowCount();

//HbA1C
$ncdHBA = "SELECT 
	count(*) 
FROM 
	lab_test 
	where 
		month(test_date)=month(:selectedDate) 
	and 
		year(test_date)=year(:selectedDate)
	and 
		hba<>''
	and
		lab_status = :lab_status
	and
		clinic_id = :cid
";
$ncdHBAExec = $conn->prepare($ncdHBA);
$ncdHBAExec->bindValue(":lab_status", $visit_status);
$ncdHBAExec->bindValue(":selectedDate", $selectedDate);
$ncdHBAExec->bindValue(":cid", $clinic_id);
$ncdHBAExec->execute();
$ncdHBAExecRes = $ncdHBAExec->fetchColumn();

//Chemistry blood test
$ncdChemistry = "SELECT 
count(*) FROM 
lab_test 
where 
month(test_date)=month(:selectedDate) 
and 
year(test_date)=year(:selectedDate)
and 
(creatinine<>'' 
or urea<>''
or ast<>''
or alt<>''
or lab_total_cholesterol<>'') 
and lab_status = :lab_status
and clinic_id=:cid
";
$ncdChemistryExec = $conn->prepare($ncdChemistry);
$ncdChemistryExec->bindValue(":lab_status", $visit_status);
$ncdChemistryExec->bindValue(":selectedDate", $selectedDate);
$ncdChemistryExec->bindValue(":cid", $clinic_id);
$ncdChemistryExec->execute();
$ncdChemistryExecRes = $ncdChemistryExec->fetchColumn();

//Foot Examination
$ncdFootExam = "SELECT 
count(*) 
FROM foot_examination
where month(date_of_exam)=month(:selectedDate)
AND
year(date_of_exam)=year(:selectedDate)
AND clinic_id=:cid
";
$ncdFootExamExec = $conn->prepare($ncdFootExam);
$ncdFootExamExec->bindValue(":selectedDate", $selectedDate);
$ncdFootExamExec->bindValue(":cid", $clinic_id);
$ncdFootExamExec->execute();
$ncdFootExamExecRes = $ncdFootExamExec->fetchColumn();

//Results
$monthArr['total_consultation']=$ncdConsultationExecRes;
$monthArr['total_patient']=$CountRow;
$monthArr['new_patient']=$ncdNewPatientExecRes;
$monthArr['medication_collection']=$ncdMedCollectionExecRes;
$monthArr['ncd_cardio']=$ncdCardioExecRes;
$monthArr['ncd_endo']=$ncdEndoExecRes;
$monthArr['himself']=$medCollectionHimself;
$monthArr['relative']=$medCollectionRelative;
$monthArr['other']=$medCollectionOther;
$monthArr['hgt']=$ncdHGTExecRes;
$monthArr['total_assessment']=$ncdAssessmentExecRes['total_assessment'];
$monthArr['average_assessment']=$ncdAssessmentExecRes['averageAssessment'];
$monthArr['lebanese_patient']=$ncdLebPatientExecRes;
$monthArr['syrian_patient']=$ncdSyrianPatientExecRes;
$monthArr['other_nationality']=$ncdOtherPatientExecRes;
$monthArr['hba']=$ncdHBAExecRes;
$monthArr['chemistry']=$ncdChemistryExecRes;
$monthArr['foot_examination']=$ncdFootExamExecRes;


//////////////////////////////////////////////////////

/////////////////////////////////////////////////////
//Total NCD Patient
$ncdPatient = "SELECT 
    count(*)
from 
	visit 
where 
	visit_status=:visit_status 
    AND clinic_id = :cid
    GROUP BY visit.patient_id
";
$ncdPatientExec = $conn->prepare($ncdPatient);
$ncdPatientExec->bindValue(":visit_status", $visit_status);
$ncdPatientExec->bindValue(":cid", $clinic_id);
$ncdPatientExec->execute();
//$ncdPatientExecRes = $ncdPatientExec->fetchAll();
$CountRow = $ncdPatientExec->rowCount();

//Total NCD Consultation
$ncdConsultation = "SELECT 
    count(*)
from 
	visit 
where 
	visit_status=:visit_status 

    AND clinic_id = :cid
";
$ncdConsultationExec = $conn->prepare($ncdConsultation);
$ncdConsultationExec->bindValue(":visit_status", $visit_status);
$ncdConsultationExec->bindValue(":cid", $clinic_id);
$ncdConsultationExec->execute();
$ncdConsultationExecRes = $ncdConsultationExec->fetchColumn();

//New patients
$ncdNewPatient = "SELECT 
    count(*)
from 
	patient 
where 
	patient_status=:visit_status 
    AND
    	clinic_id = :cid
    AND
    patient.registration_date = :currentYear
";
$ncdNewPatientExec = $conn->prepare($ncdNewPatient);
$ncdNewPatientExec->bindValue(":visit_status", $visit_status);
$ncdNewPatientExec->bindValue(":cid", $clinic_id);
$ncdNewPatientExec->bindValue(":currentYear", date("Y"));
$ncdNewPatientExec->execute();
$ncdNewPatientExecRes = $ncdNewPatientExec->fetchColumn();

//Medication Collection
$ncdMedCollection = "SELECT count(*) 
FROM 
	visit
where 
	consultation_type=:consultation_type
and 
	visit_status=:visit_status
and clinic_id = :cid
";
$ncdMedCollectionExec = $conn->prepare($ncdMedCollection);
$ncdMedCollectionExec->bindValue(":visit_status", $visit_status);
$ncdMedCollectionExec->bindValue(":consultation_type", "MedicationCollection");
$ncdMedCollectionExec->bindValue(":cid", $clinic_id);
$ncdMedCollectionExec->execute();
$ncdMedCollectionExecRes = $ncdMedCollectionExec->fetchColumn();

//NCD-Cardio
$ncdCardio = "SELECT count(*) 
FROM 
	visit
where 
	consultation_type=:consultation_type
and 
	visit_status=:visit_status
and
	clinic_id = :cid
";
$ncdCardioExec = $conn->prepare($ncdCardio);
$ncdCardioExec->bindValue(":visit_status", $visit_status);
$ncdCardioExec->bindValue(":consultation_type", "NCD – Cardiologist");
$ncdCardioExec->bindValue(":cid", $clinic_id);
$ncdCardioExec->execute();
$ncdCardioExecRes = $ncdCardioExec->fetchColumn();

//NCD-Endo
$ncdEndo = "SELECT count(*) 
FROM 
	visit
where 
	consultation_type=:consultation_type
and 
	visit_status=:visit_status
and clinic_id=:cid
";
$ncdEndoExec = $conn->prepare($ncdEndo);
$ncdEndoExec->bindValue(":visit_status", $visit_status);
$ncdEndoExec->bindValue(":consultation_type", "NCD – Endocrinologist");
$ncdEndoExec->bindValue(":cid", $clinic_id);
$ncdEndoExec->execute();
$ncdEndoExecRes = $ncdEndoExec->fetchColumn();

//Medication Collection (Himself)
$ncdMedCollectionHimself = "SELECT 
	* 
from 
	visit
left join 
	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE
	consultation_med.medication_collector=:med_collection
    AND visit.visit_status=:visit_status
    AND visit.clinic_id = :cid
group by visit.visit_id

";
$ncdMedCollectionHimselfExec = $conn->prepare($ncdMedCollectionHimself);
$ncdMedCollectionHimselfExec->bindValue(":visit_status", $visit_status);
$ncdMedCollectionHimselfExec->bindValue(":med_collection", "Himself");
$ncdMedCollectionHimselfExec->bindValue(":cid", $clinic_id);
$ncdMedCollectionHimselfExec->execute();
//$ncdEndoExecRes = $ncdEndoExec->fetchColumn();
$medCollectionHimself = $ncdMedCollectionHimselfExec->rowCount();

//Medication Collection (Relative)
$ncdMedCollectionRelative = "SELECT 
	* 
from 
	visit
left join 
	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE
	consultation_med.medication_collector=:med_collection
    AND visit.clinic_id = :cid
    AND visit.visit_status=:visit_status
group by visit.visit_id

";
$ncdMedCollectionRelativeExec = $conn->prepare($ncdMedCollectionRelative);
$ncdMedCollectionRelativeExec->bindValue(":visit_status", $visit_status);
$ncdMedCollectionRelativeExec->bindValue(":med_collection", "Relative");
$ncdMedCollectionRelativeExec->bindValue(":cid", $clinic_id);
$ncdMedCollectionRelativeExec->execute();
$medCollectionRelative = $ncdMedCollectionRelativeExec->rowCount();

//Medication Collection (Other)
$ncdMedCollectionOther = "SELECT 
	* 
from 
	visit
left join 
	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE
	consultation_med.medication_collector=:med_collection
    AND visit.visit_status=:visit_status
    AND
    visit.clinic_id=:cid
group by visit.visit_id

";
$ncdMedCollectionOtherExec = $conn->prepare($ncdMedCollectionOther);
$ncdMedCollectionOtherExec->bindValue(":visit_status", $visit_status);
$ncdMedCollectionOtherExec->bindValue(":med_collection", "Other");
$ncdMedCollectionOtherExec->bindValue(":cid", $clinic_id);
$ncdMedCollectionOtherExec->execute();
$medCollectionOther = $ncdMedCollectionOtherExec->rowCount();

//HGT
$ncdHGT = "SELECT 
	count(*) 
FROM 
	lab_test 
where 
	glycemia<>'' 
	and 
	lab_status = :visit_status
	and
	clinic_id = :cid
";
$ncdHGTExec = $conn->prepare($ncdHGT);
$ncdHGTExec->bindValue(":visit_status", $visit_status);
$ncdHGTExec->bindValue(":cid", $clinic_id);
$ncdHGTExec->execute();
$ncdHGTExecRes = $ncdHGTExec->fetchColumn();

//Assessment Numbers and average
$ncdAssessment = "SELECT
	count(assessment_result) as total_assessment, 
	avg(assessment_result) as averageAssessment
FROM 
	diabetes_assessment
where 
	clinic_id = :cid
";
$ncdAssessmentExec = $conn->prepare($ncdAssessment);
$ncdAssessmentExec->bindValue(":cid", $clinic_id);
$ncdAssessmentExec->execute();
$ncdAssessmentExecRes = $ncdAssessmentExec->fetch();

//Lebanese Nationality Patients
$ncdLebPatient = "SELECT 
	count(visit.visit_id) 
from patient left join visit on patient.patient_id=visit.patient_id Left join
	

	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE
    visit.visit_status=:visit_status
    AND patient.nationality=:nationality
    AND patient.clinic_id = :cid
group by visit.patient_id

";
$ncdLebPatientExec = $conn->prepare($ncdLebPatient);
$ncdLebPatientExec->bindValue(":visit_status", $visit_status);
$ncdLebPatientExec->bindValue(":nationality", "Lebanese");
$ncdLebPatientExec->bindValue(":cid", $clinic_id);
$ncdLebPatientExec->execute();
$ncdLebPatientExecRes = $ncdLebPatientExec->rowCount();

//Syrian Nationality Patients
$ncdSyrianPatient = "SELECT 
	count(visit.visit_id) 
from patient left join visit on patient.patient_id=visit.patient_id Left join
	

	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE
    visit.visit_status=:visit_status
    AND patient.nationality=:nationality
    AND patient.clinic_id = :cid
group by visit.patient_id

";
$ncdSyrianPatientExec = $conn->prepare($ncdSyrianPatient);
$ncdSyrianPatientExec->bindValue(":visit_status", $visit_status);
$ncdSyrianPatientExec->bindValue(":nationality", "Syrian");
$ncdSyrianPatientExec->bindValue(":cid", $clinic_id);
$ncdSyrianPatientExec->execute();
$ncdSyrianPatientExecRes = $ncdSyrianPatientExec->rowCount();

//Other Nationality Patients
$ncdOtherPatient = "SELECT 
	count(visit.visit_id) 
from patient left join visit on patient.patient_id=visit.patient_id Left join
	

	consultation
	ON
    visit.visit_id=consultation.visit_id
LEFT JOIN
	consultation_med
    ON
    consultation.consultation_id=consultation_med.consultation_id
WHERE
    visit.visit_status=:visit_status
    AND patient.nationality<>:nationality1
    AND patient.nationality<>:nationality2
    AND patient.clinic_id = :cid
group by visit.patient_id

";
$ncdOtherPatientExec = $conn->prepare($ncdOtherPatient);
$ncdOtherPatientExec->bindValue(":visit_status", $visit_status);
$ncdOtherPatientExec->bindValue(":nationality1", "Syrian");
$ncdOtherPatientExec->bindValue(":nationality2", "Lebanese");
$ncdOtherPatientExec->bindValue(":cid", $clinic_id);
$ncdOtherPatientExec->execute();
$ncdOtherPatientExecRes = $ncdOtherPatientExec->rowCount();

//HbA1C
$ncdHBA = "SELECT 
	count(*) 
FROM 
	lab_test 
	where 
		hba<>''
	and
		lab_status = :lab_status
	and
		clinic_id = :cid
";
$ncdHBAExec = $conn->prepare($ncdHBA);
$ncdHBAExec->bindValue(":lab_status", $visit_status);
$ncdHBAExec->bindValue(":cid", $clinic_id);
$ncdHBAExec->execute();
$ncdHBAExecRes = $ncdHBAExec->fetchColumn();

//Chemistry blood test
$ncdChemistry = "SELECT 
count(*) FROM 
lab_test 
where 
(creatinine<>'' 
or urea<>''
or ast<>''
or alt<>''
or lab_total_cholesterol<>'') 
and lab_status = :lab_status
and clinic_id=:cid
";
$ncdChemistryExec = $conn->prepare($ncdChemistry);
$ncdChemistryExec->bindValue(":lab_status", $visit_status);
$ncdChemistryExec->bindValue(":cid", $clinic_id);
$ncdChemistryExec->execute();
$ncdChemistryExecRes = $ncdChemistryExec->fetchColumn();

//Foot Examination
$ncdFootExam = "SELECT 
count(*) 
FROM foot_examination
WHERE
clinic_id=:cid
";
$ncdFootExamExec = $conn->prepare($ncdFootExam);
$ncdFootExamExec->bindValue(":cid", $clinic_id);
$ncdFootExamExec->execute();
$ncdFootExamExecRes = $ncdFootExamExec->fetchColumn();

//Results
$alltimeArr['total_consultation']=$ncdConsultationExecRes;
$alltimeArr['total_patient']=$CountRow;
$alltimeArr['new_patient']=$ncdNewPatientExecRes;
$alltimeArr['medication_collection']=$ncdMedCollectionExecRes;
$alltimeArr['ncd_cardio']=$ncdCardioExecRes;
$alltimeArr['ncd_endo']=$ncdEndoExecRes;
$alltimeArr['himself']=$medCollectionHimself;
$alltimeArr['relative']=$medCollectionRelative;
$alltimeArr['other']=$medCollectionOther;
$alltimeArr['hgt']=$ncdHGTExecRes;
$alltimeArr['total_assessment']=$ncdAssessmentExecRes['total_assessment'];
$alltimeArr['average_assessment']=$ncdAssessmentExecRes['averageAssessment'];
$alltimeArr['lebanese_patient']=$ncdLebPatientExecRes;
$alltimeArr['syrian_patient']=$ncdSyrianPatientExecRes;
$alltimeArr['other_nationality']=$ncdOtherPatientExecRes;
$alltimeArr['hba']=$ncdHBAExecRes;
$alltimeArr['chemistry']=$ncdChemistryExecRes;
$alltimeArr['foot_examination']=$ncdFootExamExecRes;

$finalArr = array();
$finalArr['monthArr']=$monthArr;
$finalArr['alltimeArr']=$alltimeArr;
echo json_encode($finalArr);
?>