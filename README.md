# CUR-enable-PHP-script
Use to enable AWS billing, cost and usage report (CUR), and create S3 bucket to save CUR.

Need :
1. install php in compute environment, I'm use PHP 7.1.33(cli)
1. use composer to install AWS SDK
2. Need AWS IAM User with Program Credentials keys.
3. replace the : credentials_key, credentials_secret, $bucketname, $s3location, $CURReportName into your resource name.
4. run php script 

reference : 
1. AWS PHP SDK, S3 document 
https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#createbucket
2. AWS PHP SDK, CUR document 
https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-cur-2017-01-06.html#putreportdefinition
3. Composer
https://getcomposer.org/download/
