# Load the rails application
require File.expand_path('../application', __FILE__)

# Initialize the rails application
Mongo::Application.initialize!
AWS.config(access_key_id: '...', secret_access_key: '...', region: 'us-west-2')
