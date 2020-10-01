-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2017 at 07:32 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET foreign_key_checks = 0;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ncd`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `next_appointment_date` date DEFAULT NULL,
  `next_appointment_time` time DEFAULT NULL,
  `patient_id` varchar(45) NOT NULL,
  `clinic_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `care_provider`
--

CREATE TABLE `care_provider` (
  `care_provider_id` int(11) NOT NULL,
  `care_provider_type` varchar(45) NOT NULL,
  `care_provider_function` varchar(45) NOT NULL,
  `care_provider_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `care_provider`
--
DELIMITER $$
CREATE TRIGGER `care_provider_BEFORE_INSERT` BEFORE INSERT ON `care_provider` FOR EACH ROW BEGIN

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `clinic_id` int(11) NOT NULL,
  `clinic_address` varchar(45) NOT NULL,
  `clinic_phone` varchar(45) DEFAULT NULL,
  `clinic_rep` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinic_id`, `clinic_address`, `clinic_phone`, `clinic_rep`) VALUES
(361, 'Brital', NULL, 'Ghada');

-- --------------------------------------------------------

--
-- Table structure for table `complication`
--

CREATE TABLE `complication` (
  `complication_id` int(11) NOT NULL,
  `complication_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complication`
--

INSERT INTO `complication` (`complication_id`, `complication_name`) VALUES
(1, 'Arrhythmia'),
(2, 'Heart Failure'),
(3, 'High Blood Pressure'),
(4, 'Angina'),
(5, 'Heart Attack'),
(6, 'Stroke'),
(7, 'PVD'),
(8, 'CRF'),
(9, 'Hypoglycaemia'),
(10, 'Hyperglycaemia'),
(11, 'DKA'),
(12, 'Retinopathy'),
(13, 'Neuropathy'),
(14, 'Asthma Exacerbation'),
(15, 'COPD Exacerbation');

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `consultation_id` int(11) NOT NULL,
  `nurse_list_id` int(11) DEFAULT NULL,
  `doctor_list_id` int(11) DEFAULT NULL,
  `complication_name` varchar(450) DEFAULT NULL,
  `diagnosis_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `consultation_result` varchar(450) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `patient_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `consultation_med`
--

CREATE TABLE `consultation_med` (
  `consultation_med_id` int(11) NOT NULL,
  `consultation_id` int(11) NOT NULL,
  `med_pharmacy_id` int(11) DEFAULT NULL,
  `given_quantity` int(11) DEFAULT NULL,
  `date_given` date DEFAULT NULL,
  `medication_collector` varchar(55) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cvd`
--

CREATE TABLE `cvd` (
  `cvd_id` int(11) NOT NULL,
  `cvd_date` date NOT NULL,
  `time_period` int(11) DEFAULT NULL,
  `genderVal` int(11) DEFAULT NULL,
  `patient_age` int(11) DEFAULT NULL,
  `systolic_bp` decimal(10,0) DEFAULT NULL,
  `smokerVal` int(11) DEFAULT NULL,
  `total_chol` decimal(10,0) DEFAULT NULL,
  `hdl_chol` decimal(10,0) DEFAULT NULL,
  `diabetesval` int(11) DEFAULT NULL,
  `lvhVal` int(11) DEFAULT NULL,
  `cvd_result` decimal(10,0) DEFAULT NULL,
  `visit_id` int(11) NOT NULL,
  `patient_id` varchar(45) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `diabetes_assessment`
--

CREATE TABLE `diabetes_assessment` (
  `diabetes_assessment_id` int(11) NOT NULL,
  `patient_id` varchar(45) NOT NULL,
  `date_of_assessment` date NOT NULL,
  `assessment_result` decimal(10,0) NOT NULL,
  `clinic_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `diagnosis_id` int(11) NOT NULL,
  `diagnosis_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnosis`
--


INSERT INTO `diagnosis` (`diagnosis_id`, `diagnosis_name`) VALUES
(1, 'A Regular Medication Collection Visit'),
(2, 'I05  Rheumatic mitral valve diseases (Cardio-VD)'),
(3, 'I06  Rheumatic aortic valve diseases (Cardio-VD)'),
(4, 'I07  Rheumatic tricuspid valve diseases (Cardio-VD)'),
(5, 'I08  Multiple valve diseases (Cardio-VD)'),
(6, 'I09  Other rheumatic heart diseases (Cardio-VD)'),
(7, 'I10  Essential (primary) hypertension (Cardio-VD)'),
(8, 'I11  Hypertensive heart disease (Cardio-VD)'),
(9, 'I12  Hypertensive renal disease'),
(10, 'I13  Hypertensive heart and renal disease (Cardio-VD)'),
(11, 'I15  Secondary hypertension (Cardio-VD)'),
(12, 'I20  Angina pectoris (Cardio-VD)'),
(13, 'I20.1  Angina pectoris with documented spasm (Cardio-VD)'),
(14, 'I20.8  Other forms of angina pectoris (Cardio-VD)'),
(15, 'I20.9  Angina pectoris, unspecified (Cardio-VD)'),
(16, 'I21  Acute myocardial infarction (Cardio-VD)'),
(17, 'I22  Subsequent myocardial infarction (Cardio-VD)'),
(18, 'I23  Certain current complications following acute myocardial infarction (Cardio-VD)'),
(19, 'I24  Other acute ischaemic heart diseases (Cardio-VD)'),
(20, 'I25  Chronic ischaemic heart disease (Cardio-VD)'),
(21, 'I22  Subsequent myocardial infarction (Cardio-VD)'),
(22, 'I23  Certain current complications following acute myocardial infarction (Cardio-VD)'),
(23, 'I24  Other acute ischaemic heart diseases (Cardio-VD)'),
(24, 'I25  Chronic ischaemic heart disease (Cardio-VD)'),
(25, 'J43  Emphysema (Respiratory)'),
(26, 'J44  Other chronic obstructive pulmonary disease (Respiratory)'),
(27, 'J45 Asthma (Respiratory)'),
(28, 'E00.0 Congenital iodine-deficiency syndrome, neurological type'),
(29, 'E00.1 Congenital iodine-deficiency syndrome, myxoedematous type'),
(30, 'E00.2 Congenital iodine-deficiency syndrome, mixed type'),
(31, 'E00.9 Congenital iodine-deficiency syndrome, unspecified'),
(32, 'E01.0 Iodine-deficiency-related diffuse (endemic) goitre'),
(33, 'E01.1 Iodine-deficiency-related multinodular (endemic) goitre'),
(34, 'E01.2 Iodine-deficiency-related (endemic) goitre, unspecified'),
(35, 'E01.8 Other iodine-deficiency-related thyroid disorders and allied conditions'),
(36, 'E03.9 Hypothyroidism, unspecified'),
(37, 'E03.8 Other specified hypothyroidism'),
(38, 'E8350   Unspecified disorder of calcium metabolism'),
(39, 'E048    Other specified nontoxic goiter'),
(40, 'E069    Thyroiditis, unspecified'),
(41, 'J00-J06 Acute upper respiratory infections (Respiratory)'),
(42, 'E079    Disorder of thyroid, unspecified'),
(43, 'E0840   Diabetes mellitus due to underlying condition with diabetic neuropathy, unspecified'),
(44, 'E119    Type 2 diabetes mellitus without complications'),
(45, 'E1322   Other specified diabetes mellitus with diabetic chronic kidney disease'),
(46, 'J20-J22 Other acute lower respiratory infections (Respiratory)'),
(47, 'J40-J47 Chronic lower respiratory diseases (Respiratory)'),
(48, 'J60-J70 Lung diseases due to external agents (Respiratory)'),
(49, 'J95-J99 Other diseases of the respiratory system (Respiratory)'),
(50, 'E1142   Type 2 diabetes mellitus with diabetic polyneuropathy'),
(51, 'E1040   Type 1 diabetes mellitus with diabetic neuropathy, unspecified'),
(52, 'E0821   Diabetes mellitus due to underlying condition with diabetic nephropathy'),
(53, 'E0822   Diabetes mellitus due to underlying condition with diabetic chronic kidney disease'),
(54, 'E0829   Diabetes mellitus due to underlying condition with other diabetic kidney complication'),
(55, 'E08311  Diabetes mellitus due to underlying condition with unspecified diabetic retinopathy with macular edema'),
(56, 'E08319  Diabetes mellitus due to underlying condition with unspecified diabetic retinopathy without macular edema'),
(57, 'E10621  Type 1 diabetes mellitus with foot ulcer'),
(58, 'E10628  Type 1 diabetes mellitus with other skin complications'),
(59, 'E0865   Diabetes mellitus due to underlying condition with hyperglycemia'),
(60, 'E0869   Diabetes mellitus due to underlying condition with other specified complication'),
(61, 'E088    Diabetes mellitus due to underlying condition with unspecified complications'),
(62, 'E089    Diabetes mellitus due to underlying condition without complications'),
(63, 'E10641  Type 1 diabetes mellitus with hypoglycemia with coma'),
(64, 'E1021   Type 1 diabetes mellitus with diabetic nephropathy'),
(65, 'E1022   Type 1 diabetes mellitus with diabetic chronic kidney disease'),
(66, 'E1029   Type 1 diabetes mellitus with other diabetic kidney complication'),
(67, 'E162    Hypoglycemia, unspecified'),
(68, 'E200    Idiopathic hypoparathyroidism'),
(69, 'E209    Hypoparathyroidism, unspecified'),
(70, 'E214    Other specified disorders of parathyroid gland'),
(71, 'E232    Diabetes insipidus'),
(72, 'E278    Other specified disorders of adrenal gland'),
(73, 'E300    Delayed puberty'),
(74, 'E282    Polycystic ovarian syndrome'),
(75, 'E28310  Symptomatic premature menopause'),
(76, 'E348    Other specified endocrine disorders'),
(77, 'E349    Endocrine disorder, unspecified'),
(78, 'E509    Vitamin A deficiency, unspecified'),
(79, 'E550    Rickets, active'),
(80, 'E669    Obesity, unspecified'),
(81, 'E739    Lactose intolerance, unspecified'),
(82, 'E782    Mixed hyperlipidemia'),
(83, 'E784    Other hyperlipidemia'),
(84, 'E8319   Other disorders of iron metabolism'),
(85, 'E832    Disorders of zinc metabolism'),
(86, 'E8350   Unspecified disorder of calcium metabolism'),
(87, 'Glaucoma'),
(88, 'Arrhythmia'),
(89, 'Tachycardia'),
(90, 'Depression'),
(91, 'Epilepsy');
-- --------------------------------------------------------

--
-- Table structure for table `doctor_list`
--

CREATE TABLE `doctor_list` (
  `doctor_list_id` int(11) NOT NULL,
  `doctor_name` varchar(55) NOT NULL,
  `doctor_status` varchar(45) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_list`
--

INSERT INTO `doctor_list` (`doctor_list_id`, `doctor_name`, `doctor_status`, `clinic_id`) VALUES
(1, 'Nasry Tofaily', 'Active', 361),
(2, 'Ali Nasser Eldin', 'Active', 361),
(3, 'Samer Chaib', 'Active', 361),
(4, 'Ali Chouman', 'Active', 361),
(5, 'Fadi Abdallah', 'Active', 361),
(6, 'Fadel Mortada', 'Active', 361),
(7, 'Haitham Tabikh', 'Active', 361),
(8, 'Abbas Saif Edine', 'Active', 361),
(9, 'Abbas Nasser', 'Active', 361),
(10, 'Nelly  Komolove', 'Active', 361),
(11, 'Abbas Chahin', 'Active', 361);

-- --------------------------------------------------------

--
-- Table structure for table `foot_examination`
--

CREATE TABLE `foot_examination` (
  `food_examination_id` int(11) NOT NULL,
  `patient_id` varchar(45) NOT NULL,
  `date_of_exam` date NOT NULL,
  `prev_ulcer_left` varchar(3) DEFAULT NULL,
  `prev_ulcer_right` varchar(3) DEFAULT NULL,
  `prev_amputation_left` varchar(3) DEFAULT NULL,
  `prev_amputation_right` varchar(3) DEFAULT NULL,
  `deformity_left` varchar(3) DEFAULT NULL,
  `deformity_right` varchar(3) DEFAULT NULL,
  `absent_pedal_pulse_left` varchar(3) DEFAULT NULL,
  `absent_pedal_pulse_right` varchar(3) DEFAULT NULL,
  `active_ulcer_left` varchar(3) DEFAULT NULL,
  `active_ulcer_right` varchar(3) DEFAULT NULL,
  `ingrown_toenail_left` varchar(3) DEFAULT NULL,
  `ingrown_toenail_right` varchar(3) DEFAULT NULL,
  `calluses_left` varchar(3) DEFAULT NULL,
  `calluses_right` varchar(3) DEFAULT NULL,
  `blisters_left` varchar(3) DEFAULT NULL,
  `blisters_right` varchar(3) DEFAULT NULL,
  `fissure_left` varchar(3) DEFAULT NULL,
  `fissure_right` varchar(3) DEFAULT NULL,
  `monofilament_right_left` varchar(3) DEFAULT NULL,
  `monofilament_left_left` varchar(3) DEFAULT NULL,
  `monofilament_right_right` varchar(3) DEFAULT NULL,
  `monofilament_left_right` varchar(3) DEFAULT NULL,
  `clinic_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_privilige` varchar(10) NOT NULL,
  `clinic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `username`, `password`, `user_privilige`, `clinic_id`) VALUES
(1, 'brital', '043826bf1aaf033fdda0ad9ceb6063bd', 'user', 361),
(2, 'brital', '2b85adcac2e1730e44c8d3b0c658d1cd', 'admin', 361);

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `med_id` int(11) NOT NULL,
  `med_name` varchar(75) NOT NULL,
  `med_date_added` date DEFAULT NULL,
  `clinic_id` varchar(45) DEFAULT NULL,
  `med_type` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`med_id`, `med_name`, `med_date_added`, `clinic_id`, `med_type`) VALUES
(1, 'Propranolol 10mg (Inderal 10mg) Tablets ', NULL, '361', 'chronic'),
(2, 'Propranolol 40mg (Inderal 40mg) Tablets ', NULL, '361', 'chronic'),
(3, 'Diltiazem 60mg (Tildiem 60mg) Tablets', NULL, '361', 'chronic'),
(4, 'Isosorbide Dinitrate 5mg (Isordil 5mg) Tablets ', NULL, '361', 'chronic'),
(5, 'Isosorbide Dinitrate 10mg (Isordil 10mg) Tablets ', NULL, '361', 'chronic'),
(6, 'Isosorbide Dinitrate 20mg (Isordil 20mg) Tablets ', NULL, '361', 'chronic'),
(7, 'Nifedipine 20mg Retard (Adalat 20mg) Tablets ', NULL, '361', 'chronic'),
(8, 'Amiodarone 200mg( Cordarone200) Tablets ', NULL, '361', 'chronic'),
(9, 'Verapamil 80mg (Isoptine80mg Tablets ', NULL, '361', 'chronic'),
(10, 'Atenolol 50mg (Tenormine 50mg) Tablets ', NULL, '361', 'chronic'),
(11, 'Atenolol 100mg (Tenormine 100mg) Tablets ', NULL, '361', 'chronic'),
(12, 'Captopril 50mg (Capoten 50mg) Tablets ', NULL, '361', 'chronic'),
(13, 'Methyldopa 250mg (Aldomet) Tablets ', NULL, '361', 'chronic'),
(14, 'Digoxin 0.25mg (Lanoxin )Tablets ', NULL, '361', 'chronic'),
(15, 'Dipyridamol 75mg (Persantine 75mg) Tablets ', NULL, '361', 'chronic'),
(16, 'Acenocoumarol 4mg( Sintrom) Tablets ', NULL, '361', 'chronic'),
(17, 'Ticlopidine 250mg( Ticlid )Tablets', NULL, '361', 'chronic'),
(18, 'Amlodipine 5mg (Amlor 5) Tablets', NULL, '361', 'chronic'),
(19, 'Molsidomine 2mg (Corvasal2 )Tablets', NULL, '361', 'chronic'),
(20, 'Molsidomine 4mg (Corvasal4) Tablets', NULL, '361', 'chronic'),
(21, 'Bisoprolol Fumarate 5mg (Concor5 )Tablets ', NULL, '361', 'chronic'),
(22, 'Quinapril 20mg (Acuitel20) Tablets ', NULL, '361', 'chronic'),
(23, 'Lisinopril 10mg( Zestril10) Tablets ', NULL, '361', 'chronic'),
(24, 'acetylsalicylic acid 100mg tab', NULL, '361', 'chronic'),
(25, 'Furosemide 40mg( Lasix 40)Tablets ', NULL, '361', 'chronic'),
(26, 'Indapamide1.5mg ( Natrilix) Tablets ', NULL, '361', 'chronic'),
(27, 'Spironolactone 25mg ( Aldactone 25) Tablets ', NULL, '361', 'chronic'),
(28, 'Amiloride/Htz 5/50mg ( Moduretic ) Tablets ', NULL, '361', 'chronic'),
(29, 'Albendazole 100mg', NULL, '361', 'non chronic'),
(30, 'Glibenclamide 5mg ( Daonil ) Tablets ', NULL, '361', 'chronic'),
(31, 'Gliclazid 80mg ( Diamicron80) Tablets ', NULL, '361', 'chronic'),
(32, 'Metformin 850mg ( Glucophage ) Tablets ', NULL, '361', 'chronic'),
(33, 'Glucophage 500 Mg ( Glucophage) Tablets ', NULL, '361', 'chronic'),
(34, 'Glimepiride 4mgAmaryl 4mg Tablets 41190', NULL, '361', 'chronic'),
(35, 'Metformin 1000mg ( Glucophage retard ) Tablets ', NULL, '361', 'chronic'),
(36, 'Glimepiride 2mg (Amaryl 2) Tablets ', NULL, '361', 'chronic'),
(37, 'Glimepiride 3mg (Amaryl 3) Tablets', NULL, '361', 'chronic'),
(38, 'Glimepiride 1mg (amaryl 1) Tablets', NULL, '361', 'chronic'),
(39, 'Antipsychotics', NULL, '361', 'chronic'),
(40, 'Metformin 1000 mg tb XR', NULL, '361', 'chronic'),
(41, 'Metformin 750 mg tb XR', NULL, '361', 'chronic'),
(42, 'Metformin500 mg tb XR', NULL, '361', 'chronic'),
(43, 'Furosemide 40mg tab', NULL, '361', 'chronic'),
(44, 'Haloperidol 5mg ( Haldol 5) Tablets ', NULL, '361', 'chronic'),
(45, 'Chlorpromazine 50mg( Largactil 50) Tablets ', NULL, '361', 'chronic'),
(46, 'Chlorpromazine 100mg (Largactil 100) Tablets ', NULL, '361', 'chronic'),
(47, 'Antiepileptic – Antiparkinson', NULL, '361', 'chronic'),
(48, 'Amitriptylline 25mg (Tryptizol 25)Tablets ', NULL, '361', 'chronic'),
(49, 'Carbamazepine 200mg (Tegretol 200Tablets ', NULL, '361', 'chronic'),
(50, 'Phenytoin 100mg ( Epanutin 100)Tablets ', NULL, '361', 'chronic'),
(51, 'Trihexephenidyl 5mg ( Artane) Tablets ', NULL, '361', 'chronic'),
(52, 'Carbidopa Levidopa 25mg, 250mg ( Sinemet25-250) Tablets ', NULL, '361', 'chronic'),
(53, 'Sodium Valproate 200mg ( Depakine 200) Tablets ', NULL, '361', 'chronic'),
(54, 'Sodium Valproate 500mg ( Depakine 500) Tablets ', NULL, '361', 'chronic'),
(55, 'Respiratory Tract', NULL, '361', NULL),
(56, 'Theophylline 100mg ( Aminophylline100) Tabs, Supp ', NULL, '361', 'chronic'),
(57, 'Salbutamol 4mg( Ventolin4) Tablets ', NULL, '361', 'chronic'),
(58, 'Salbutamol Inhaler Ventolin Inhaler Inhaler ', NULL, '361', 'chronic'),
(59, 'Clenil / 250mg Spray Forte Inhaler ', NULL, '361', 'chronic'),
(60, 'Hyperlypemia', NULL, '361', 'generic'),
(61, 'Fenofibrate 100mg ( Lipanthyl 100)Tablets ', NULL, '361', 'chronic'),
(62, 'Fenofibrate 200mg ( Lipanthyl 200)Tablets ', NULL, '361', 'chronic'),
(63, 'Simvastatin 20mg ( Zocor 20)Tablets ', NULL, '361', 'chronic'),
(64, 'Antigout', NULL, '361', NULL),
(65, 'Allopurinol 100mg ( Zyloric100) Tablets ', NULL, '361', 'chronic'),
(66, 'Loratidine 10mg tab', NULL, '361', 'non chronic'),
(67, 'Ranitidine 150mg ( Zantac 150)Tablets ', NULL, '361', 'chronic'),
(68, 'Lanzoprazol 30mg ( Lanzor30) Tablets', NULL, '361', 'chronic'),
(69, 'Thyroid Problems', NULL, '361', NULL),
(70, 'Levothyroxin 0.1mg ( Eltroxin 0.1mg)Tablets ', NULL, '361', 'chronic'),
(71, 'Ocular Hypertension', NULL, '361', NULL),
(72, 'Timolol 0.05% (Timoptol 0.5%) Drops ', NULL, '361', 'chronic'),
(73, 'Acetazolamide 250mg (Diamox ) Tablets ', NULL, '361', 'chronic'),
(74, 'Retinopathy', NULL, '361', NULL),
(75, 'Dobesilate De Calcium 500mg (Doxium) Tablets ', NULL, '361', 'chronic'),
(76, 'Osteoporosis', NULL, '361', NULL),
(77, 'Calcium-D Caltrate 600 Tablets ', NULL, '361', 'chronic'),
(78, 'Naproxen 375mg (Anaprox 375) Tablets ', NULL, '361', 'non chronic'),
(79, 'Naproxen 500mg ( Anaprox 500)Tablets ', NULL, '361', 'non chronic'),
(80, 'Ibuprofen 400mg tab', NULL, '361', 'non chronic'),
(81, 'EDICINES NAME TYPE Quantity/Month', NULL, '361', NULL),
(82, 'Cough Formula Child & Adult Syrup 30,000', NULL, '361', 'non chronic'),
(83, 'Tylenol Child Bubble Gum Syrup 50,000', NULL, '361', 'non chronic'),
(84, 'Ibuprofen 200mg tab', NULL, '361', 'non chronic'),
(85, 'Tylenol Cherry Drops 1,000', NULL, '361', 'non chronic'),
(86, 'Tylenol Throat Adult 8 Oz Syrup 10,000', NULL, '361', 'non chronic'),
(87, 'Brufen Child 100/5ml 4 Oz Syrup 5,000', NULL, '361', 'non chronic'),
(88, 'Brufen Motrin Infant 1/2 Oz Drops 2,000', NULL, '361', 'non chronic'),
(89, 'Motrin Advil 200mg Tab 10,000', NULL, '361', 'non chronic'),
(90, 'Ceftin Cefuroxine 125mg/5ml Syrup 3,000', NULL, '361', 'non chronic'),
(91, 'Ceftin Cefuroxine 100mg/5ml P.M Suspention 10,000', NULL, '361', 'non chronic'),
(92, 'Ceftin Cefuroxine 100mg/5ml G.M Suspention 10,000', NULL, '361', 'non chronic'),
(93, 'Ceftin Cefuroxine 250mg/5ml Syrup 10,000', NULL, '361', 'non chronic'),
(94, 'Ceftin 250mg Tab 5,000', NULL, '361', 'non chronic'),
(95, 'Ceftin 500mg Tab 5,000', NULL, '361', 'non chronic'),
(96, 'Augmentin 375mg Tab 5,000', NULL, '361', 'non chronic'),
(97, 'Augmentin 100ml Syrup 5,000', NULL, '361', 'non chronic'),
(98, 'Augmentin 312mg Injection 5,000', NULL, '361', 'non chronic'),
(99, 'Augmentin 1.2g Ampoul 10,000', NULL, '361', 'non chronic'),
(100, 'Augmentin Infant 62.5/20ml Drops 5,000', NULL, '361', 'non chronic'),
(101, 'Augmentin 600mg Ampoul 10,000', NULL, '361', 'non chronic'),
(102, 'Gauze Compress Boxes 50,000', NULL, '361', 'non chronic'),
(103, 'Cotton Bags 10,000', NULL, '361', 'non chronic'),
(104, 'Antiseptic Powder 10 Oz Powder 10,000', NULL, '361', 'non chronic'),
(105, 'Amoxicillin/clavulanic acid tab 1gr                                        ', NULL, '361', 'non chronic'),
(106, 'Povidine Iodine 16 Oz Solution 10,000', NULL, '361', 'non chronic'),
(107, 'Band Aid (All Sizes) Boxes 50,000', NULL, '361', 'non chronic'),
(108, 'Micropore Tapes (Different Sizes) Tapes 2,000', NULL, '361', 'non chronic'),
(109, 'Triple Antibiotic Ointment 50,000', NULL, '361', 'non chronic'),
(110, 'Azithromycin 250 mg blister tab', NULL, '361', 'non chronic'),
(111, 'Beclometason,200 puffs,inhaler', NULL, '361', 'non chronic'),
(112, 'Cefixime 400 mg', NULL, '361', 'non chronic'),
(113, 'Cephalexine 250mg/5ml susp', NULL, '361', 'non chronic'),
(114, 'Cephalexine 500 mg cp', NULL, '361', 'non chronic'),
(115, 'Chlorphenaramine 4mg tb', NULL, '361', 'non chronic'),
(116, 'Ciprofloxacintb 500mg', NULL, '361', 'non chronic'),
(117, 'Cotrimoxazole 400mg/80mg breakable tab', NULL, '361', 'non chronic'),
(118, 'Cotrimoxazole 200mg/40mg/5ml,oral sol 100ml btl', NULL, '361', 'non chronic'),
(119, 'Doxycycline hydrochloride   100mg tb', NULL, '361', 'non chronic'),
(120, 'Ferrous fumarate 185mg (60mg iron)/folic acid 0.4mg ,tb', NULL, '361', 'non chronic'),
(121, 'Flucanazole 150mg tab', NULL, '361', 'non chronic'),
(122, 'Folic acid 5mg tb', NULL, '361', 'non chronic'),
(123, 'Metoclopramide hydrochloride tab', NULL, '361', 'non chronic'),
(124, 'Metronidazole125mg/5ml syrup', NULL, '361', 'non chronic'),
(125, 'Hyoscine butyibromide 10mg tab', NULL, '361', 'non chronic'),
(126, 'Metronidazole 500mg tab', NULL, '361', 'non chronic'),
(127, 'Omeprazole 20 mg', NULL, '361', 'chronic'),
(128, 'Paracetamol 500 mg tab', NULL, '361', 'non chronic'),
(129, 'Polygynax ovule', NULL, '361', 'non chronic'),
(130, 'Rhinathiol promethazine syr 125ml', NULL, '361', 'non chronic'),
(131, 'Paracetamol syrup 120mg/5ml', NULL, '361', 'non chronic'),
(132, 'levonorgestrel 750 postiner', NULL, '361', 'non chronic'),
(133, 'loratidine 5mg/5ml syr 100 ml bot', NULL, '361', 'non chronic'),
(134, 'Microgynon ED FE(levonorgestrel 0.15 )   eth', NULL, '361', 'non chronic'),
(135, 'Microlut(levonorgestrel 0.03mg tab', NULL, '361', 'non chronic'),
(136, 'Nystatin 500000UI/ml syr', NULL, '361', 'non chronic'),
(137, 'ORS', NULL, '361', 'non chronic'),
(138, 'Zinc sulphate or gluconate', NULL, '361', 'non chronic'),
(139, 'Vitamins and minerals tab', NULL, '361', 'non chronic'),
(140, 'Salbutamol,200 puffs, 0.1mg /puff,inhaler', NULL, '361', 'chronic'),
(141, 'Rifampicine tab 300 mg', NULL, '361', 'non chronic'),
(142, 'Injectables', NULL, '361', NULL),
(143, 'Depo-provera (medroxyprogesterone Depo150 mg) amp', NULL, '361', 'non chronic'),
(144, 'Ramipril 5mg (Tritace 5)', NULL, '361', 'chronic'),
(145, 'Ramipril 10mg (Tritace 10)', NULL, '361', 'chronic'),
(146, 'Valsartan 80mg (Diovan 80)', NULL, '361', 'chronic'),
(147, 'HTZ 25 (Esidrex)', NULL, '361', 'chronic'),
(148, 'Fluoxetine 20mg (Prozac 20mg)', NULL, '361', 'chronic'),
(149, 'Sertraline 50mg (Zoloft)', NULL, '361', 'chronic'),
(150, 'Beclomethasone INHALER 50µg (Becotide 50µg)', NULL, '361', 'chronic'),
(151, 'Ipratropium (Atrovent)', NULL, '361', 'chronic'),
(152, 'Montelukast 5mg (Singulair 5mg)', NULL, '361', 'chronic'),
(153, 'Montelukast 10mg (Singulair 10mg)', NULL, '361', 'chronic'),
(154, 'Rosuvastatin 10mg (Crestor 10mg)', NULL, '361', 'chronic'),
(155, 'Levothyroxin 0.025mg (Eltroxin)', NULL, '361', 'chronic'),
(156, 'Clopidogrel 75mg (Plavix)', NULL, '361', 'chronic'),
(157, 'Carbamazepine 400mg (Tegretol 400)', NULL, '361', 'chronic'),
(158, 'Sodium Valproate 500mg Chrono MG (Depakine 500 CR)', NULL, '361', 'chronic'),
(159, 'Sodium Valproate 200mg/5ml (Depakine SUSP)', NULL, '361', 'chronic'),
(160, 'Dorzolamide 20mg/ml+Timolol (Cosopt)', NULL, '361', 'chronic'),
(161, 'Captopril 25mg (Capoten 25mg) Tablets', NULL, '361', 'chronic'),
(162, 'Amlodipine 10mg (Amlor 10) Tablets', NULL, '361', 'chronic'),
(163, 'Beclomethasone INHALER 250µg (Becotide 250µg)', NULL, '361', 'chronic'),
(164, 'Allopurinol 300mg ( Zyloric300) Tablets', NULL, '361', 'chronic'),
(165, 'Gliclazid 30mg LP', NULL, '361', 'chronic'),
(166, 'acetylsalicylic acid 81mg tab', NULL, '361', 'chronic');
-- --------------------------------------------------------

--
-- Table structure for table `med_pharmacy`
--

CREATE TABLE `med_pharmacy` (
  `med_pharmacy_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL,
  `med_barcode` varchar(45) DEFAULT NULL,
  `med_received` date DEFAULT NULL,
  `med_expiry` date DEFAULT NULL,
  `med_tablet` int(11) DEFAULT NULL,
  `med_pill` int(11) DEFAULT NULL,
  `clinic_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nurse_list`
--

CREATE TABLE `nurse_list` (
  `nurse_list_id` int(11) NOT NULL,
  `nurse_name` varchar(45) NOT NULL,
  `nurse_status` varchar(45) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nurse_list`
--

INSERT INTO `nurse_list` (`nurse_list_id`, `nurse_name`, `nurse_status`, `clinic_id`) VALUES
(1, 'Ghada Ismail', 'Active', 361),
(2, 'Mohamad Mazloum', 'Active', 361),
(3, 'Zeinab Ismail', 'Active', 361),
(4, 'Diaa Al Hassan', 'Active', 361),
(5, 'Hussein Mazloum', 'Active', 361),
(6, 'Mariam Wehbe ', 'Active', 361),
(7, 'Christine Melhem', 'Active', 361),
(8, 'Bilal Abbas', 'Active', 361),
(9, 'Amad Sous', 'Active', 361);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` varchar(45) NOT NULL,
  `ymca_id` varchar(45) NOT NULL,
  `patient_name_en` varbinary(150) NOT NULL,
  `patient_name_ar` varbinary(150) NOT NULL,
  `patient_mother_name` varbinary(110) DEFAULT NULL,
  `dob` date NOT NULL,
  `gender` varchar(7) NOT NULL,
  `registration_date` date NOT NULL,
  `patient_address` varchar(45) DEFAULT NULL,
  `patient_phone` varbinary(110) DEFAULT NULL,
  `patient_smoker` varchar(15) DEFAULT NULL,
  `smoker_number_of_packets` int(11) DEFAULT NULL,
  `alcohol` varchar(12) DEFAULT NULL,
  `patient_alt_name` varchar(60) DEFAULT NULL,
  `patient_alt_contact_add` varchar(75) DEFAULT NULL,
  `relation` varchar(45) DEFAULT NULL,
  `nationality` varchar(25) DEFAULT NULL,
  `unhcr_registration_number` varbinary(110) DEFAULT NULL,
  `comment` varchar(150) DEFAULT NULL,
  `blood_type` varchar(45) DEFAULT NULL,
  `clinic_id` int(11) NOT NULL,
  `patient_status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_allergy`
--

CREATE TABLE `patient_allergy` (
  `patient_allergy_id` int(11) NOT NULL,
  `patient_allergy_med` varchar(60) NOT NULL,
  `med_side_effect` varchar(45) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `patient_id` varchar(45) NOT NULL,
  `clinic_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_edited`
--

CREATE TABLE `patient_edited` (
  `patient_edited_id` int(11) NOT NULL,
  `patient_id` varchar(45) NOT NULL,
  `patient_name_en` varbinary(150) DEFAULT NULL,
  `patient_name_ar` varbinary(150) DEFAULT NULL,
  `patient_mother_name` varbinary(110) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `patient_address` varchar(45) DEFAULT NULL,
  `patient_phone` varbinary(110) DEFAULT NULL,
  `patient_smoker` varchar(3) DEFAULT NULL,
  `smoker_number_of_packets` int(11) DEFAULT NULL,
  `alcohol` varchar(12) DEFAULT NULL,
  `patient_alt_name` varchar(60) DEFAULT NULL,
  `patient_alt_contact_add` varchar(75) DEFAULT NULL,
  `relation` varchar(45) DEFAULT NULL,
  `nationality` varchar(25) DEFAULT NULL,
  `unhcr_registration_number` varbinary(110) DEFAULT NULL,
  `comment` varchar(150) DEFAULT NULL,
  `blood_type` varchar(45) DEFAULT NULL,
  `clinic_id` int(11) NOT NULL,
  `patient_status` varchar(15) DEFAULT NULL,
  `date_of_edit` date DEFAULT NULL,
  `comment_on_edit` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_family_history`
--

CREATE TABLE `patient_family_history` (
  `patient_family_history_id` int(11) NOT NULL,
  `patient_id` varchar(45) NOT NULL,
  `diagnosis` varchar(650) DEFAULT NULL,
  `clinic_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_med_history`
--

CREATE TABLE `patient_med_history` (
  `patient_medication_id` int(11) NOT NULL,
  `patient_medication` varchar(55) DEFAULT NULL,
  `patient_side_effect` varchar(55) DEFAULT NULL,
  `disease` varchar(80) DEFAULT NULL,
  `patient_id` varchar(45) NOT NULL,
  `clinic_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status_history`
--

CREATE TABLE `status_history` (
  `status_history_id` int(11) NOT NULL,
  `patient_status` varchar(15) NOT NULL,
  `status_date` date NOT NULL,
  `patient_id` varchar(45) NOT NULL,
  `clinic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surgical_info`
--

CREATE TABLE `surgical_info` (
  `surgical_info_id` int(11) NOT NULL,
  `patient_surgery` varchar(450) DEFAULT NULL,
  `comment` varchar(450) DEFAULT NULL,
  `surgery_date` date DEFAULT NULL,
  `patient_id` varchar(45) NOT NULL,
  `clinic_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `visit_id` int(11) NOT NULL,
  `date_of_visit` date NOT NULL,
  `visit_reason` varchar(145) DEFAULT NULL,
  `consultation_type` varchar(25) DEFAULT NULL,
  `patient_weight` decimal(10,0) DEFAULT NULL,
  `patient_height` decimal(10,0) DEFAULT NULL,
  `patient_pressure` varchar(10) NOT NULL,
  `visit_status` varchar(45) DEFAULT NULL,
  `patient_id` varchar(45) NOT NULL,
  `clinic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `lab_test`
--

CREATE TABLE `lab_test` (
  `lab_id` int(11) NOT NULL,
  `clinic_id` varchar(45) NOT NULL,
  `patient_id` varchar(45) NOT NULL,
  `lab_status` varchar(12) NOT NULL,
  `test_date` date NOT NULL,
  `glycemia` varchar(15) DEFAULT NULL,
  `hba` varchar(15) DEFAULT NULL,
  `creatinine` varchar(15) DEFAULT NULL,
  `urea` varchar(15) DEFAULT NULL,
  `ast` varchar(15) DEFAULT NULL,
  `alt` varchar(15) DEFAULT NULL,
  `lab_total_cholesterol` varchar(15) DEFAULT NULL,
  `lab_hdl_cholesterol` varchar(15) DEFAULT NULL,
  `lab_comment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -----------------------------------------------------
-- Table `ncd`.`patient_consent`
-- -----------------------------------------------------
CREATE TABLE `ncd`.`patient_consent` (
  `patient_consent_id` INT NOT NULL AUTO_INCREMENT,
  `clinic_staff` VARCHAR(3) NOT NULL,
  `ymca_staff` VARCHAR(3) NOT NULL,
  `medair_staff` VARCHAR(3) NOT NULL,
  `patient_id` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`patient_consent_id`),
  INDEX `fk_patient_consent_patient1_idx` (`patient_id` ASC),
  CONSTRAINT `fk_patient_consent_patient1`
    FOREIGN KEY (`patient_id`)
    REFERENCES `ncd`.`patient` (`patient_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `ncd`.`treatment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ncd`.`treatment` (
  `treatment_id` INT NOT NULL AUTO_INCREMENT,
  `patient_id` VARCHAR(45) NOT NULL,
  `old_treatment` VARCHAR(450) NULL,
  `new_treatment` VARCHAR(450) NULL,
  `treatment_status` VARCHAR(10) NULL,
  `clinic_id` VARCHAR(45) NOT NULL,
  `date_of_change` DATE NOT NULL,
  `dateAdded` DATETIME NOT NULL,
  PRIMARY KEY (`treatment_id`),
  INDEX `fk_treatment_patient1_idx` (`patient_id` ASC),
  CONSTRAINT `fk_treatment_patient1`
    FOREIGN KEY (`patient_id`)
    REFERENCES `ncd`.`patient` (`patient_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;
--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `fk_appointment_patient1_idx` (`patient_id`);

--
-- Indexes for table `care_provider`
--
ALTER TABLE `care_provider`
  ADD PRIMARY KEY (`care_provider_id`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`clinic_id`);

--
-- Indexes for table `complication`
--
ALTER TABLE `complication`
  ADD PRIMARY KEY (`complication_id`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`consultation_id`),
  ADD KEY `fk_consultation_nurse_list1_idx` (`nurse_list_id`),
  ADD KEY `fk_consultation_doctor_list1_idx` (`doctor_list_id`),
  ADD KEY `fk_consultation_visit1_idx` (`visit_id`),
  ADD KEY `fk_consultation_diagnosis1_idx` (`diagnosis_id`);

--
-- Indexes for table `consultation_med`
--
ALTER TABLE `consultation_med`
  ADD PRIMARY KEY (`consultation_med_id`),
  ADD KEY `fk_diagnosis_visit_consultation1_idx` (`consultation_id`),
  ADD KEY `fk_consultation_med_med_pharmacy1_idx` (`med_pharmacy_id`);

--
-- Indexes for table `cvd`
--
ALTER TABLE `cvd`
  ADD PRIMARY KEY (`cvd_id`),
  ADD KEY `fk_cvd_visit1_idx` (`visit_id`);

--
-- Indexes for table `diabetes_assessment`
--
ALTER TABLE `diabetes_assessment`
  ADD PRIMARY KEY (`diabetes_assessment_id`),
  ADD KEY `fk_diabetes_assessment_patient1_idx` (`patient_id`);

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`diagnosis_id`);

--
-- Indexes for table `doctor_list`
--
ALTER TABLE `doctor_list`
  ADD PRIMARY KEY (`doctor_list_id`);

--
-- Indexes for table `foot_examination`
--
ALTER TABLE `foot_examination`
  ADD PRIMARY KEY (`food_examination_id`,`patient_id`),
  ADD KEY `fk_food_examination_patient1_idx` (`patient_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `fk_login_clinic_idx` (`clinic_id`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `med_pharmacy`
--
ALTER TABLE `med_pharmacy`
  ADD PRIMARY KEY (`med_pharmacy_id`),
  ADD KEY `fk_med_pharmacy_medication1_idx` (`med_id`);

--
-- Indexes for table `nurse_list`
--
ALTER TABLE `nurse_list`
  ADD PRIMARY KEY (`nurse_list_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `fk_patient_clinic1_idx` (`clinic_id`);

--
-- Indexes for table `patient_allergy`
--
ALTER TABLE `patient_allergy`
  ADD PRIMARY KEY (`patient_allergy_id`),
  ADD KEY `fk_patient_allergy_patient1_idx` (`patient_id`);

--
-- Indexes for table `patient_edited`
--
ALTER TABLE `patient_edited`
  ADD PRIMARY KEY (`patient_edited_id`),
  ADD KEY `fk_patient_edited_clinic1_idx` (`clinic_id`);

--
-- Indexes for table `patient_family_history`
--
ALTER TABLE `patient_family_history`
  ADD PRIMARY KEY (`patient_family_history_id`),
  ADD KEY `fk_patient_family_history_patient1_idx` (`patient_id`);

--
-- Indexes for table `patient_med_history`
--
ALTER TABLE `patient_med_history`
  ADD PRIMARY KEY (`patient_medication_id`),
  ADD KEY `fk_patient_medication_patient1_idx` (`patient_id`);

--
-- Indexes for table `status_history`
--
ALTER TABLE `status_history`
  ADD PRIMARY KEY (`status_history_id`),
  ADD KEY `fk_status_history_patient1_idx` (`patient_id`);

--
-- Indexes for table `surgical_info`
--
ALTER TABLE `surgical_info`
  ADD PRIMARY KEY (`surgical_info_id`),
  ADD KEY `fk_surgical_info_patient1_idx` (`patient_id`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `fk_visit_patient1_idx` (`patient_id`);

--
-- Indexes for table `lab_test`
--
ALTER TABLE `lab_test`
  ADD PRIMARY KEY (`lab_id`),
  ADD KEY `fk_lab_test_patient1_idx` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `care_provider`
--
ALTER TABLE `care_provider`
  MODIFY `care_provider_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complication`
--
ALTER TABLE `complication`
  MODIFY `complication_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `consultation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `consultation_med`
--
ALTER TABLE `consultation_med`
  MODIFY `consultation_med_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cvd`
--
ALTER TABLE `cvd`
  MODIFY `cvd_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `diabetes_assessment`
--
ALTER TABLE `diabetes_assessment`
  MODIFY `diabetes_assessment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `diagnosis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `doctor_list`
--
ALTER TABLE `doctor_list`
  MODIFY `doctor_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `foot_examination`
--
ALTER TABLE `foot_examination`
  MODIFY `food_examination_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `med_pharmacy`
--
ALTER TABLE `med_pharmacy`
  MODIFY `med_pharmacy_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nurse_list`
--
ALTER TABLE `nurse_list`
  MODIFY `nurse_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `patient_allergy`
--
ALTER TABLE `patient_allergy`
  MODIFY `patient_allergy_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient_edited`
--
ALTER TABLE `patient_edited`
  MODIFY `patient_edited_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient_family_history`
--
ALTER TABLE `patient_family_history`
  MODIFY `patient_family_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient_med_history`
--
ALTER TABLE `patient_med_history`
  MODIFY `patient_medication_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status_history`
--
ALTER TABLE `status_history`
  MODIFY `status_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `surgical_info`
--
ALTER TABLE `surgical_info`
  MODIFY `surgical_info_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_test`
--
ALTER TABLE `lab_test`
  MODIFY `lab_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_appointment_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `fk_consultation_diagnosis1` FOREIGN KEY (`diagnosis_id`) REFERENCES `diagnosis` (`diagnosis_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_consultation_doctor_list1` FOREIGN KEY (`doctor_list_id`) REFERENCES `doctor_list` (`doctor_list_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_consultation_nurse_list1` FOREIGN KEY (`nurse_list_id`) REFERENCES `nurse_list` (`nurse_list_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_consultation_visit1` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`visit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consultation_med`
--
ALTER TABLE `consultation_med`
  ADD CONSTRAINT `fk_consultation_med_med_pharmacy1` FOREIGN KEY (`med_pharmacy_id`) REFERENCES `med_pharmacy` (`med_pharmacy_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_diagnosis_visit_consultation1` FOREIGN KEY (`consultation_id`) REFERENCES `consultation` (`consultation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cvd`
--
ALTER TABLE `cvd`
  ADD CONSTRAINT `fk_cvd_visit1` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`visit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diabetes_assessment`
--
ALTER TABLE `diabetes_assessment`
  ADD CONSTRAINT `fk_diabetes_assessment_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foot_examination`
--
ALTER TABLE `foot_examination`
  ADD CONSTRAINT `fk_food_examination_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_login_clinic` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `med_pharmacy`
--
ALTER TABLE `med_pharmacy`
  ADD CONSTRAINT `fk_med_pharmacy_medication1` FOREIGN KEY (`med_id`) REFERENCES `medication` (`med_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `fk_patient_clinic1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_allergy`
--
ALTER TABLE `patient_allergy`
  ADD CONSTRAINT `fk_patient_allergy_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_edited`
--
ALTER TABLE `patient_edited`
  ADD CONSTRAINT `fk_patient_edited_clinic1` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_family_history`
--
ALTER TABLE `patient_family_history`
  ADD CONSTRAINT `fk_patient_family_history_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_med_history`
--
ALTER TABLE `patient_med_history`
  ADD CONSTRAINT `fk_patient_medication_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status_history`
--
ALTER TABLE `status_history`
  ADD CONSTRAINT `fk_status_history_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surgical_info`
--
ALTER TABLE `surgical_info`
  ADD CONSTRAINT `fk_surgical_info_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `fk_visit_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lab_test`
--
ALTER TABLE `lab_test`
  ADD CONSTRAINT `fk_lab_test_patient1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
