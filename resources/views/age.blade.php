
                <div class="col-md-3" id="age{{$key}}">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">face</i>
                            <button type="button" aria-hidden="true" class="close" onclick="close_age({{$key}})">
                                    <i class="material-icons">close</i>
                                </button>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Age From (0 - no matter)</h4>
                            <div class="form-group label-floating">
                                <label></label>
                                <input class="form-control" type="number" min="0" max=99

                                       name="age_from[]"/>
                            </div>
                            <div class="form-group label-floating">
                                <h4 class="card-title">Age To (0 - no matter)</h4>
                                <input class="form-control" type="number" min="0" max=99
                                       name="age_to[]"/>

                            </div>
                        </div>
                    </div>
                </div>
