<?php 
require 'vendor/autoload.php';
use Aws\CostandUsageReportService\CostandUsageReportServiceClient;
use Aws\S3;
use Aws\Exception\AwsException;

$credentials = new Aws\Credentials\Credentials(<credentials_key>, <credentials_secret>);
$bucketname = 'cur-php-bucket';
$s3location = 'ap-southeast-1';
$CURReportName = 'CUR-PHPCall';

$policy = file_get_contents('./bucketpolicy.config');
$policy = str_replace('{$bucketname}', $bucketname, $policy);

$s3 = new Aws\S3\S3Client([
    'version'     => 'latest',
    'region'      => 'ap-southeast-1',
    'credentials' => $credentials
]);

try {
	$createBucketResult = $s3->createBucket([
		'Bucket' => "{$bucketname}",
		'CreateBucketConfiguration' => ['LocationConstraint' => $s3location ] 
		//'LocationConstraint' => 'ap-northeast-1|ap-southeast-2|ap-southeast-1|cn-north-1|eu-central-1|eu-west-1|us-east-1|us-west-1|us-west-2|sa-east-1'
	]);
} catch (Exception $e) {
	echo $e;
}

try {
	$bucketPolicyResult = $s3->putBucketPolicy([
	    'Bucket' => $bucketname, // REQUIRED
	    'Policy' => $policy, // REQUIRED
	]);
} catch (Exception $e) {
	echo $;
}


$client = new CostandUsageReportServiceClient([
    'region' => 'us-east-1',
    'credentials' => $credentials,
    'version' => 'latest'] );
 
try {
	$result = $client->putReportDefinition([
		'ReportDefinition' => [
			'AdditionalArtifacts' => ['ATHENA' ],
	        'AdditionalSchemaElements' => ['RESOURCES' ], // REQUIRED
	        'Compression' => 'Parquet', // REQUIRED
	        'Format' => 'Parquet', // REQUIRED
	        'RefreshClosedReports' => true,
	        'ReportName' => $CURReportName, // REQUIRED
	        'ReportVersioning' => 'OVERWRITE_REPORT',
	        'S3Bucket' => $bucketname, // REQUIRED
	        'S3Prefix' => , // REQUIRED
	        'S3Region' => $s3location, // REQUIRED
	        'TimeUnit' => 'HOURLY', // REQUIRED
		],
	]);
} catch (Exception $e) {
	echo $e;
}
