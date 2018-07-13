(function(){

    var fessmodule = angular.module("myApp");
     
    var reviseCtrl=function($scope, $filter, $http, $route){

        // init
        $scope.sort = {       
                    sortingOrder : 'id',
                    reverse : false
                };
        
        $scope.gap = 5;
        
        $scope.filteredItems = [];
        $scope.groupedItems = [];
        $scope.itemsPerPage = 5;
        $scope.pagedItems = [];
        $scope.currentPage = 0;
        $scope.items=[];
        $http.get("models/revise.php")
            .then(function (response) {
                $scope.items = response.data.records;
                $scope.search();
            });
        $scope.test = [
            {"id":1,"name":"name 1"}];

        $scope.editItem = function(myId, myName){
            $http.post("models/edit.php",{
                'id':myId
                ,'newValue':myName
            }).then(function(response){
                console.log("Data edited correctly. "+response.data);
                $route.reload();
            }, function(error){
                alert("Editing failed");
            });
        };

        $scope.delete = function(myId){
            $http.post("models/delete.php",{
                'id':myId
            }).then(function(response){
                console.log("Data deleted correctly. "+response.data);
                $route.reload();
            }, function(error){
                alert("Delete failed");
            });
        };

        var searchMatch = function (haystack, needle) {
            if (!needle) {
                return true;
            }
            return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
        };

        // init the filtered items
        $scope.search = function () {
            $scope.filteredItems = $filter('filter')($scope.items, function (item) {
                for(var attr in item) {
                    if (searchMatch(item[attr], $scope.query))
                        return true;
                }
                return false;
            });
            // take care of the sorting order
            if ($scope.sort.sortingOrder !== '') {
                $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sort.sortingOrder, $scope.sort.reverse);
            }
            $scope.currentPage = 0;
            // now group by pages
            $scope.groupToPages();
        };
        
      
        // calculate page in place
        $scope.groupToPages = function () {
            $scope.pagedItems = [];
            
            for (var i = 0; i < $scope.filteredItems.length; i++) {
                if (i % $scope.itemsPerPage === 0) {
                    $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [ $scope.filteredItems[i] ];
                } else {
                    $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.filteredItems[i]);
                }
            }
        };
        
        $scope.range = function (size,start, end) {
            var ret = [];        
            //console.log(size,start, end);
                          
            if (size < end) {
                end = size;
                var newStart = size - $scope.gap;
                start = newStart<0 ? 0 : newStart;
            }
            for (var i = start; i < end; i++) {
                ret.push(i);
            }        
             //console.log(ret);        
            return ret;
        };
        
        $scope.prevPage = function () {
            if ($scope.currentPage > 0) {
                $scope.currentPage--;
            }
        };
        
        $scope.nextPage = function () {
            if ($scope.currentPage < $scope.pagedItems.length - 1) {
                $scope.currentPage++;
            }
        };
        
        $scope.setPage = function () {
            $scope.currentPage = this.n;
        };
    };

    fessmodule.controller('reviseCtrl', reviseCtrl);

    fessmodule.$inject = ['$scope', '$filter'];

    fessmodule.directive("customSort", function() {
    return {
        restrict: 'A',
        transclude: true,    
        scope: {
          order: '=',
          sort: '='
        },
        template : 
          ' <a ng-click="sort_by(order)" style="color: #555555;">'+
          '    <span ng-transclude></span>'+
          '    <i ng-class="selectedCls(order)"></i>'+
          '</a>',
        link: function(scope) {
                    
        // change sorting order
        scope.sort_by = function(newSortingOrder) {       
            var sort = scope.sort;
            
            if (sort.sortingOrder == newSortingOrder){
                sort.reverse = !sort.reverse;
            }                    

            sort.sortingOrder = newSortingOrder;        
        };
        
       
        scope.selectedCls = function(column) {
            if(column == scope.sort.sortingOrder){
                return ('icon-chevron-' + ((scope.sort.reverse) ? 'down' : 'up'));
            }
            else{            
                return'icon-sort' 
            } 
        };      
      }
    }
    });
}());