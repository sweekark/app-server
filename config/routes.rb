Mongo::Application.routes.draw do

#match 'discovers/:route_id' => 'discovers#index', :defaults => {:format => 'json'}, :via => [:get]
  resources :discovers,
:defaults => { :format => 'json' }


  resources :activities,
:defaults => { :format => 'json' }


match 'activities/get' => 'activities#index', :defaults => {:format => 'json'}, :via => [:post]
match 'follows/:user_id' => 'follows#index', :defaults => {:format => 'json'}, :via => [:get]
match 'comments/get' => 'comments#index', :defaults => {:format => 'json'}, :via => [:post]
resources :follows,
:defaults => { :format => 'json' }


resources :travel_times,
	  :defaults => { :format => 'json' }

resources :auths

resources :images

match 'routes' => 'routes#index', :defaults => {:format => 'json'}, :via => [:post]
match 'routes/create' => 'routes#create', :defaults => {:format => 'json'}, :via => [:post]
resources :routes,
	  :defaults => { :format => 'json' }


resources :comments,
:defaults => { :format => 'json' }


resources :posts

resources :users,
:defaults => { :format => 'json' }


resources :projects


resources :articles

end
